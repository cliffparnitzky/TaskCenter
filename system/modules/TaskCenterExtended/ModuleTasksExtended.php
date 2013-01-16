<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2011 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  Leo Feyer 2005-2011
 * @author     Leo Feyer <http://www.contao.org>
 * @package    Backend
 * @license    LGPL
 * @filesource
 */


/**
 * Class ModuleTasksExtended
 *
 * Back end module "tasks".
 * @copyright  Leo Feyer 2005-2011
 * @author     Leo Feyer <http://www.contao.org>
 * @package    Controller
 */
class ModuleTasksExtended extends BackendModule
{

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'be_tasks_extended';

	/**
	 * Save input
	 * @var boolean
	 */
	protected $blnSave = true;

	/**
	 * Advanced mode
	 * @var boolean
	 */
	protected $blnAdvanced = true;
	
	public function __construct()
	{
		parent::__construct();
	} 
	
	/**
	 * Generate the module
	 */
	protected function compile()
	{
		$this->import('TaskCenterMailSender', 'MailSender');
		$this->import('BackendUser', 'User');
		$this->loadLanguageFile('tl_task');

		switch ($this->Input->get('act'))
		{
			case 'create':
				$this->createTask();
				break;

			case 'edit':
				$this->editTask();
				break;

			case 'delete':
				$this->deleteTask();
				break;

			case 'show':
				$this->showTask();
				break;

			default:
				$this->showAllTasks();
				break;
		}
		
		$this->Template->request = ampersand($this->Environment->request, true);		
		
		// Load scripts
		$GLOBALS['TL_CSS'][] = 'system/modules/TaskCenterExtended/html/taskcenter.css'; 
	}


	/**
	 * Show all tasks
	 */
	protected function showAllTasks()
	{
		$this->Template->tasks = array();

		// Clean up
		$this->Database->execute("DELETE FROM tl_task WHERE tstamp=0");
		$this->Database->execute("DELETE FROM tl_task_status WHERE tstamp=0");
		$this->Database->execute("DELETE FROM tl_task_status WHERE pid NOT IN(SELECT id FROM tl_task)");

		// Set default variables
		$this->Template->apply = $GLOBALS['TL_LANG']['MSC']['apply'];
		$this->Template->noTasks = $GLOBALS['TL_LANG']['tl_task']['noTasks'];
		$this->Template->createTitle = $GLOBALS['TL_LANG']['tl_task']['new'][1];
		$this->Template->createLabel = $GLOBALS['TL_LANG']['tl_task']['new'][0];
		$this->Template->editLabel = $GLOBALS['TL_LANG']['tl_task']['edit'][0];
		$this->Template->deleteLabel = $GLOBALS['TL_LANG']['tl_task']['delete'][0];
		$this->Template->showLabel = $GLOBALS['TL_LANG']['tl_task']['show'][0];

		$this->Template->thId = $GLOBALS['TL_LANG']['tl_task']['t.id'];
		$this->Template->thProject = $GLOBALS['TL_LANG']['tl_task']['project'][0];
		$this->Template->thProjectShort = $GLOBALS['TL_LANG']['tl_task']['project']['short'];
		$this->Template->thTasktype = $GLOBALS['TL_LANG']['tl_task']['tasktype'][0];
		$this->Template->thTasktypeShort = $GLOBALS['TL_LANG']['tl_task']['tasktype']['short'];
		$this->Template->thTitle = $GLOBALS['TL_LANG']['tl_task']['title'][0];
		$this->Template->thTitleShort = $GLOBALS['TL_LANG']['tl_task']['title']['short'];
		$this->Template->thAssignedTo = $GLOBALS['TL_LANG']['tl_task']['assignedTo'][0];
		$this->Template->thAssignedToShort = $GLOBALS['TL_LANG']['tl_task']['assignedTo']['short'];
		$this->Template->thPriority = $GLOBALS['TL_LANG']['tl_task']['priority'][0];
		$this->Template->thPriorityShort = $GLOBALS['TL_LANG']['tl_task']['priority']['short'];
		$this->Template->thStatus = $GLOBALS['TL_LANG']['tl_task']['status'][0];
		$this->Template->thStatusShort = $GLOBALS['TL_LANG']['tl_task']['status']['short'];
		$this->Template->thProgress = $GLOBALS['TL_LANG']['tl_task']['progress'][0];
		$this->Template->thProgressShort = $GLOBALS['TL_LANG']['tl_task']['progress']['short'];
		$this->Template->thDeadline = $GLOBALS['TL_LANG']['tl_task']['deadline'][0];
		$this->Template->thDeadlineShort = $GLOBALS['TL_LANG']['tl_task']['deadline']['short'];
		
		$this->Template->tableUseShortNames = $this->User->taskcenterColumnsShortnameUsage;
		$this->Template->tableUseIcons = $this->User->taskcenterIconUsage;
		
		$columnConfig = $this->User->taskcenterColumnsVisibility;
		if (!is_array($columnConfig))
		{
			$columnConfig = array();
		}
		
		$this->Template->tableColumnVisibleProject    = in_array('project', $columnConfig);
		$this->Template->tableColumnVisibleTasktype   = in_array('tasktype', $columnConfig);
		$this->Template->tableColumnVisibleTitle      = in_array('title', $columnConfig);
		$this->Template->tableColumnVisibleAssignedTo = in_array('assignedTo', $columnConfig);
		$this->Template->tableColumnVisiblePriority   = in_array('priority', $columnConfig);
		$this->Template->tableColumnVisibleStatus     = in_array('status', $columnConfig);
		$this->Template->tableColumnVisibleProgress   = in_array('progress', $columnConfig);
		$this->Template->tableColumnVisibleDeadline   = in_array('deadline', $columnConfig);
		
		$this->Template->createHref = $this->addToUrl('act=create');

		// Get task object
		if (($objTask = $this->getTaskObject()) != true)
		{
			return;
		}

		$count = -1;
		$time = time();
		$max = ($objTask->numRows - 1);
		$arrTasks = array();
		
		$this->loadDataContainer('tl_task');
		$this->loadDataContainer('tl_task_status');

		// List tasks
		while ($objTask->next())
		{
			$trClass = 'row_' . ++$count . (($count == 0) ? ' row_first' : '') . (($count >= $max) ? ' row_last' : '') . (($count % 2 == 0) ? ' odd' : ' even');
			$tdClass = $GLOBALS['TL_DCA']['tl_task_status'][$objTask->status]['class'];
			$tdStyle = $GLOBALS['TL_DCA']['tl_task_status'][$objTask->status]['style'];

			// Completed
			if ($objTask->status != 'completed' && $objTask->deadline < $time)
			{
				$tdClass = $GLOBALS['TL_DCA']['tl_task']['deadline']['class'];
				$tdStyle = $GLOBALS['TL_DCA']['tl_task']['deadline']['style'];
			}

			$deleteHref = '';
			$deleteTitle = '';
			$deleteIcon = 'system/themes/' . $this->getTheme() . '/images/delete_.gif';
			$deleteConfirm = '';

			// Check delete permissions
			if ($this->User->isAdmin || $this->User->id == $objTask->createdBy)
			{
				$deleteHref = $this->addToUrl('act=delete&amp;id=' . $objTask->id);
				$deleteTitle = sprintf($GLOBALS['TL_LANG']['tl_task']['delete'][1], $objTask->id);
				$deleteIcon = 'system/themes/' . $this->getTheme() . '/images/delete.gif';
				$deleteConfirm = sprintf($GLOBALS['TL_LANG']['tl_task']['delConfirm'], $objTask->id);
			}

			$arrTasks[] = array
			(
				'id' => $objTask->id,
				'user' => $objTask->name,
				'projectName' => $objTask->projectName,
				'title' => $objTask->title,
				'progress' => $objTask->progress,
				'deadline' => $this->parseDate($GLOBALS['TL_CONFIG']['dateFormat'], $objTask->deadline),
				'creator' => sprintf($GLOBALS['TL_LANG']['tl_task']['createdBy'], $objTask->creator),
				'editHref' => $this->addToUrl('act=edit&amp;id=' . $objTask->id),
				'editTitle' => sprintf($GLOBALS['TL_LANG']['tl_task']['edit'][1], $objTask->id),
				'editIcon' => 'system/themes/' . $this->getTheme() . '/images/edit.gif',
				'deleteHref' => $deleteHref,
				'deleteTitle' => $deleteTitle,
				'deleteIcon' => $deleteIcon,
				'deleteConfirm' => $deleteConfirm,
				'showHref' => $this->addToUrl('act=show&amp;id=' . $objTask->id),
				'showTitle' => sprintf($GLOBALS['TL_LANG']['tl_task']['show'][1], $objTask->id),
				'showIcon' => 'system/themes/' . $this->getTheme() . '/images/show.gif',
				'trClass' => $trClass,
				'tdClass' => $tdClass,
				'tdStyle' => $tdStyle,
				'status' => $objTask->status,
				'statusLabel' => (strlen($GLOBALS['TL_LANG']['tl_task_status'][$objTask->status]) ? $GLOBALS['TL_LANG']['tl_task_status'][$objTask->status] : $objTask->status),
				'statusIcon' => 'system/modules/TaskCenterExtended/html/status_' . $objTask->status . '.png',
				'tasktype' => $objTask->tasktype,
				'tasktypeLabel' => (strlen($GLOBALS['TL_LANG']['tl_task_tasktype'][$objTask->tasktype]) ? $GLOBALS['TL_LANG']['tl_task_tasktype'][$objTask->tasktype] : $objTask->tasktype),
				'tasktypeIcon' => 'system/modules/TaskCenterExtended/html/tasktype_' . $objTask->tasktype . '.png',
				'priority' => $objTask->priority,
				'priorityLabel' => (strlen($GLOBALS['TL_LANG']['tl_task_priority'][$objTask->priority]) ? $GLOBALS['TL_LANG']['tl_task_priority'][$objTask->priority] : $objTask->priority),
				'priorityIcon' => 'system/modules/TaskCenterExtended/html/priority_' . $this->User->taskcenterIconPriorityIconSet . '_' .$objTask->priority . '.png'
			);
		}

		$this->Template->tasks = $arrTasks;
	}


	/**
	 * Create a task
	 */
	protected function createTask()
	{
		$this->Template = new BackendTemplate('be_task_extended_create');

		if (!$GLOBALS['TL_CONFIG']['oldBeTheme'])
		{
			$this->Template = new BackendTemplate('be_task_extended_create_be27');
			$fs = $this->Session->get('fieldset_states');

			$this->Template->projectClass = (isset($fs['tl_tasks']['project_legend']) && !$fs['tl_tasks']['project_legend']) ? ' collapsed' : '';
			$this->Template->titleClass = (isset($fs['tl_tasks']['title_legend']) && !$fs['tl_tasks']['title_legend']) ? ' collapsed' : '';
			$this->Template->categoryClass = (isset($fs['tl_tasks']['category_legend']) && !$fs['tl_tasks']['category_legend']) ? ' collapsed' : '';
			$this->Template->assignClass = (isset($fs['tl_tasks']['assign_legend']) && !$fs['tl_tasks']['assign_legend']) ? ' collapsed' : '';
			$this->Template->statusClass = (isset($fs['tl_tasks']['status_legend']) && !$fs['tl_tasks']['status_legend']) ? ' collapsed' : '';
			$this->Template->historyClass = (isset($fs['tl_tasks']['history_legend']) && !$fs['tl_tasks']['history_legend']) ? ' collapsed' : '';
		}

		$this->Template->project = $this->getProjectWidget();
		$this->Template->title = $this->getTitleWidget();
		$this->Template->deadline = $this->getDeadlineWidget();
		$this->Template->assignedTo = $this->getAssignedToWidget();
		$this->Template->tasktype = $this->getTasktypeWidget('exercise');
		$this->Template->priority = $this->getPriorityWidget('3_normal');
		$this->Template->notify = $this->getNotifyWidget();
		$this->Template->comment = $this->getCommentWidget();

		$this->Template->goBack = $GLOBALS['TL_LANG']['MSC']['goBack'];
		$this->Template->headline = $GLOBALS['TL_LANG']['tl_task']['new'][1];
		$this->Template->submit = $GLOBALS['TL_LANG']['tl_task']['createSubmit'];
		$this->Template->submitAndEdit = $GLOBALS['TL_LANG']['tl_task']['createSubmitAndEdit'];
		$this->Template->submitAndNew = $GLOBALS['TL_LANG']['tl_task']['createSubmitAndNew'];
		$this->Template->projectLabel = $GLOBALS['TL_LANG']['tl_task']['project'][0];
		$this->Template->titleLabel = $GLOBALS['TL_LANG']['tl_task']['title'][0];
		$this->Template->categoryLabel = $GLOBALS['TL_LANG']['tl_task']['tasktype'][0] . ' / ' . $GLOBALS['TL_LANG']['tl_task']['priority'][0];
		$this->Template->assignLabel = $GLOBALS['TL_LANG']['tl_task']['assignedTo'][0];
		$this->Template->statusLabel = $GLOBALS['TL_LANG']['tl_task']['status'][0];
		$this->Template->tasktypeLabel = $GLOBALS['TL_LANG']['tl_task']['tasktype'][0];
		$this->Template->priorityLabel = $GLOBALS['TL_LANG']['tl_task']['priority'][0];

		// Create task
		if ($this->Input->post('FORM_SUBMIT') == 'tl_tasks' && $this->blnSave)
		{
			$time = time();
			$deadline = new Date($this->Template->deadline->value, $GLOBALS['TL_CONFIG']['dateFormat']);

			// Insert task
			$arrSet = array
			(
				'tstamp' => $time,
				'createdBy' => $this->User->id,
				'project' => $this->Template->project->value,
				'title' => $this->Template->title->value,
				'tasktype' => $this->Template->tasktype->value,
				'priority' => $this->Template->priority->value,
				'deadline' => $deadline->dayBegin
			);

			$objTaskInsertId = $this->Database->prepare("INSERT INTO tl_task %s")->set($arrSet)->execute()->insertId;
			$objTask = $this->Database->prepare("SELECT *, (SELECT name FROM tl_user u WHERE u.id=t.createdBy) AS creator, (SELECT shortname FROM tl_task_project p WHERE p.id=t.project) AS projectName FROM tl_task t WHERE id=?")
								  ->limit(1)
								  ->execute($objTaskInsertId);

			// Insert status
			$arrSet = array
			(
				'pid' => $objTaskInsertId,
				'tstamp' => $time,
				'assignedTo' => $this->Template->assignedTo->value,
				'comment' => trim($this->Template->comment->value),
				'status' => 'created',
				'progress' => 0,
				'commentBy' => $this->User->id
			);

			$this->Database->prepare("INSERT INTO tl_task_status %s")->set($arrSet)->execute();

			// Notify user
			if ($this->Input->post('notify'))
			{
				$this->MailSender->sendNotificationMail($objTask, $arrSet, $this->User);
			}

			if (isset($_POST['saveAndEdit']))
			{
				$this->redirect('contao/main.php?do=tasks&act=edit&id=' . $objTaskInsertId);
			}
			else if (isset($_POST['saveAndNew']))
			{
				$this->redirect('contao/main.php?do=tasks&act=create');
			}
			else
			{
				// Go back
				$this->redirect('contao/main.php?do=tasks');
			}
		}
	}


	/**
	 * Edit a task
	 */
	protected function editTask()
	{
		$this->Template = new BackendTemplate('be_task_extended_edit');

		if (!$GLOBALS['TL_CONFIG']['oldBeTheme'])
		{
			$this->Template = new BackendTemplate('be_task_extended_edit_be27');
			$fs = $this->Session->get('fieldset_states');

			$this->Template->projectClass = (isset($fs['tl_tasks']['project_legend']) && !$fs['tl_tasks']['project_legend']) ? ' collapsed' : '';
			$this->Template->titleClass = (isset($fs['tl_tasks']['title_legend']) && !$fs['tl_tasks']['title_legend']) ? ' collapsed' : '';
			$this->Template->categoryClass = (isset($fs['tl_tasks']['category_legend']) && !$fs['tl_tasks']['category_legend']) ? ' collapsed' : '';
			$this->Template->assignClass = (isset($fs['tl_tasks']['assign_legend']) && !$fs['tl_tasks']['assign_legend']) ? ' collapsed' : '';
			$this->Template->statusClass = (isset($fs['tl_tasks']['status_legend']) && !$fs['tl_tasks']['status_legend']) ? ' collapsed' : '';
			$this->Template->historyClass = (isset($fs['tl_tasks']['history_legend']) && !$fs['tl_tasks']['history_legend']) ? ' collapsed' : '';
		}

		$this->Template->goBack = $GLOBALS['TL_LANG']['MSC']['goBack'];
		$this->Template->headline = sprintf($GLOBALS['TL_LANG']['tl_task']['edit'][1], $this->Input->get('id'));

		$objTask = $this->Database->prepare("SELECT *, (SELECT name FROM tl_user u WHERE u.id=t.createdBy) AS creator, (SELECT shortname FROM tl_task_project p WHERE p.id=t.project) AS projectName  FROM tl_task t WHERE id=?")
								  ->limit(1)
								  ->execute($this->Input->get('id'));

		if ($objTask->numRows < 1)
		{
			$this->log('Invalid task ID "' . $this->Input->get('id') . '"', 'ModuleTask editTask()', TL_ERROR);
			$this->redirect('contao/main.php?act=error');
		}

		// Check if the user is allowed to edit the task
		$this->blnAdvanced = ($this->User->isAdmin || $objTask->createdBy == $this->User->id);
		$this->Template->advanced = $this->blnAdvanced;

		$this->Template->project = $this->blnAdvanced ? $this->getProjectWidget($objTask->project) : $objTask->project;
		$this->Template->title = $this->blnAdvanced ? $this->getTitleWidget($objTask->title) : $objTask->title;
		$this->Template->deadline = $this->blnAdvanced ? $this->getDeadlineWidget($this->parseDate($GLOBALS['TL_CONFIG']['dateFormat'], $objTask->deadline)) : $this->parseDate($GLOBALS['TL_CONFIG']['dateFormat'], $objTask->deadline);

		$arrHistory = array();

		// Get the status
		$objStatus = $this->Database->prepare("SELECT *, (SELECT name FROM tl_user u WHERE u.id=s.assignedTo) AS name, (SELECT name FROM tl_user u WHERE u.id=s.commentBy) AS commentBy FROM tl_task_status s WHERE pid=? ORDER BY tstamp " . $this->User->taskcenterHistorySorting)
									->execute($this->Input->get('id'));

		while($objStatus->next())
		{
			$arrHistory[] = array
			(
				'creator' => $objTask->creator,
				'date' => $this->parseDate($GLOBALS['TL_CONFIG']['dateFormat'], $objStatus->tstamp),
				'statusValue' => $objStatus->status,
				'status' => (strlen($GLOBALS['TL_LANG']['tl_task_status'][$objStatus->status]) ? $GLOBALS['TL_LANG']['tl_task_status'][$objStatus->status] : $objStatus->status),
				'comment' => $this->restoreBasicEntities($objStatus->comment),
				'assignedTo' => $objStatus->assignedTo,
				'progress' => $objStatus->progress,
				'class' => $objStatus->status,
				'name' => $objStatus->name,
				'commentBy' => $objStatus->commentBy
			);
		}
		
		$lastStatus = $arrHistory[0];
		if ($this->User->taskcenterHistorySorting == "ASC")
		{
			$lastStatus = $arrHistory[sizeof($arrHistory) - 1];
		}

		$this->Template->tasktype = $this->getTasktypeWidget($objTask->tasktype);
		$this->Template->priority = $this->getPriorityWidget($objTask->priority);
		$this->Template->assignedTo = $this->getAssignedToWidget($lastStatus['assignedTo']);
		$this->Template->notify = $this->getNotifyWidget();
		$this->Template->status = $this->getStatusWidget($lastStatus['statusValue'], $lastStatus['progress']);
		$this->Template->progress = $this->getProgressWidget($lastStatus['progress']);
		$this->Template->comment = $this->getCommentWidget();

		// Update task
		if ($this->Input->post('FORM_SUBMIT') == 'tl_tasks' && $this->blnSave)
		{
		
			// Update task
			if ($this->blnAdvanced)
			{
				$deadline = new Date($this->Template->deadline->value, $GLOBALS['TL_CONFIG']['dateFormat']);

				$this->Database->prepare("UPDATE tl_task SET project=?, title=?, deadline=?, tasktype=?, priority=? WHERE id=?")
							   ->execute($this->Template->project->value, $this->Template->title->value, $deadline->dayBegin, $this->Template->tasktype->value, $this->Template->priority->value, $this->Input->get('id'));
			}

			// Insert status
			$arrSet = array
			(
				'pid' => $this->Input->get('id'),
				'tstamp' => time(),
				'assignedTo' => $this->Template->assignedTo->value,
				'status' => $this->Template->status->value,
				'progress' => (($this->Template->status->value == 'completed') ? 100 : $this->Template->progress->value),
				'comment' => trim($this->Template->comment->value),
				'commentBy' => $this->User->id
			);

			$this->Database->prepare("INSERT INTO tl_task_status %s")->set($arrSet)->execute();

			// Notify user
			if ($this->Input->post('notify'))
			{
				$this->MailSender->sendNotificationMail($objTask, $arrSet, $this->User);
			}
			
			if (isset($_POST['save']))
			{
				$this->redirect('contao/main.php?do=tasks&act=edit&id=' . $this->Input->get('id'));
			}
			else
			{
				// Go back
				$this->redirect('contao/main.php?do=tasks');
			}
		}

		$this->Template->history = $arrHistory;
		$this->Template->historyLabel = $GLOBALS['TL_LANG']['tl_task']['history'];
		$this->Template->deadlineLabel = $GLOBALS['TL_LANG']['tl_task']['deadline'][0];
		$this->Template->dateLabel = $GLOBALS['TL_LANG']['tl_task']['date'];
		$this->Template->assignedToLabel = $GLOBALS['TL_LANG']['tl_task']['assignedTo'][0];
		$this->Template->createdByLabel = $GLOBALS['TL_LANG']['tl_task']['creator'];
		$this->Template->statusLabel = $GLOBALS['TL_LANG']['tl_task']['status'][0];
		$this->Template->progressLabel = $GLOBALS['TL_LANG']['tl_task']['progress'][0];
		$this->Template->submit = $GLOBALS['TL_LANG']['tl_task']['editSubmit'];
		$this->Template->submitAndClose = $GLOBALS['TL_LANG']['tl_task']['editSubmitAndClose'];
		$this->Template->projectLabel = $GLOBALS['TL_LANG']['tl_task']['project'][0]; 
		$this->Template->titleLabel = $GLOBALS['TL_LANG']['tl_task']['title'][0];
		$this->Template->categoryLabel = $GLOBALS['TL_LANG']['tl_task']['tasktype'][0] . ' / ' . $GLOBALS['TL_LANG']['tl_task']['priority'][0];
		$this->Template->assignLabel = $GLOBALS['TL_LANG']['tl_task']['assignedTo'][0];
		$this->Template->tasktypeLabel = $GLOBALS['TL_LANG']['tl_task']['tasktype'][0];
		$this->Template->priorityLabel = $GLOBALS['TL_LANG']['tl_task']['priority'][0];
	}
	
	/**
	 * Show a task
	 */
	protected function showTask()
	{
		$this->Template = new BackendTemplate('be_task_extended_show');

		$this->Template->goBack = $GLOBALS['TL_LANG']['MSC']['goBack'];
		$this->Template->headline = sprintf($GLOBALS['TL_LANG']['tl_task']['show'][1], $this->Input->get('id'));

		$objTask = $this->Database->prepare("SELECT *, (SELECT name FROM tl_user u WHERE u.id=t.createdBy) AS creator, "
													. "(SELECT name FROM tl_task_project p WHERE p.id=t.project) AS projectName, "
													. "(SELECT shortname FROM tl_task_project p WHERE p.id=t.project) AS projectShortname "
													. "FROM tl_task t WHERE id=?")
								  ->limit(1)
								  ->execute($this->Input->get('id'));

		if ($objTask->numRows < 1)
		{
			$this->log('Invalid task ID "' . $this->Input->get('id') . '"', 'ModuleTask showTask()', TL_ERROR);
			$this->redirect('contao/main.php?act=error');
		}

		$arrHistory = array();

		// Get the status
		$objStatus = $this->Database->prepare("SELECT *, (SELECT name FROM tl_user u WHERE u.id=s.assignedTo) AS name, (SELECT name FROM tl_user u WHERE u.id=s.commentBy) AS commentBy FROM tl_task_status s WHERE pid=? ORDER BY tstamp " . $this->User->taskcenterHistorySorting)
									->execute($this->Input->get('id'));

		while($objStatus->next())
		{
			$arrHistory[] = array
			(
				'creator' => $objTask->creator,
				'date' => $this->parseDate($GLOBALS['TL_CONFIG']['datimFormat'], $objStatus->tstamp),
				'status' => (strlen($GLOBALS['TL_LANG']['tl_task_status'][$objStatus->status]) ? $GLOBALS['TL_LANG']['tl_task_status'][$objStatus->status] : $objStatus->status),
				'comment' => $this->restoreBasicEntities($objStatus->comment),
				'assignedTo' => $objStatus->assignedTo,
				'progress' => $objStatus->progress,
				'class' => $objStatus->status,
				'name' => $objStatus->name,
				'commentBy' => $objStatus->commentBy
			);
		}

		$this->Template->id = $objTask->id;
		$this->Template->idLabel = $GLOBALS['TL_LANG']['tl_task']['t.id'];

		$this->Template->projectName =  "[" . $objTask->projectShortname . "] - " . $objTask->projectName;
		$this->Template->projectNameLabel = $GLOBALS['TL_LANG']['tl_task']['project'][0];

		$this->Template->title = $objTask->title;
		$this->Template->titleLabel = $GLOBALS['TL_LANG']['tl_task']['title'][0];

		$this->Template->createdBy = $objTask->creator;
		$this->Template->createdByLabel = $GLOBALS['TL_LANG']['tl_task']['creator'];

		$this->Template->date = $this->parseDate($GLOBALS['TL_CONFIG']['datimFormat'], $objTask->tstamp);
		$this->Template->dateLabel = $GLOBALS['TL_LANG']['tl_task']['date'];

		$this->Template->deadline = $this->parseDate($GLOBALS['TL_CONFIG']['dateFormat'], $objTask->deadline);
		$this->Template->deadlineLabel = $GLOBALS['TL_LANG']['tl_task']['deadline'][0];

		$this->Template->tasktype = $GLOBALS['TL_LANG']['tl_task_tasktype'][$objTask->tasktype];
		$this->Template->tasktypeLabel = $GLOBALS['TL_LANG']['tl_task']['tasktype'][0];

		$this->Template->priority = $GLOBALS['TL_LANG']['tl_task_priority'][$objTask->priority];
		$this->Template->priorityLabel = $GLOBALS['TL_LANG']['tl_task']['priority'][0];

		$this->Template->assignedTo = $objStatus->name;
		$this->Template->assignedToLabel = $GLOBALS['TL_LANG']['tl_task']['assignedTo'][0];

		$this->Template->status = $GLOBALS['TL_LANG']['tl_task_status'][$objStatus->status];
		$this->Template->statusLabel = $GLOBALS['TL_LANG']['tl_task']['status'][0];

		$this->Template->progress = $objStatus->progress;
		$this->Template->progressLabel = $GLOBALS['TL_LANG']['tl_task']['progress'][0];

		$this->Template->lastUpdateLabel = $GLOBALS['TL_LANG']['tl_task']['lastUpdate'];
		
		$lastUpdatePosition = 0;
		if ($this->User->taskcenterHistorySorting == "ASC")
		{
			$lastUpdatePosition = sizeof($arrHistory) - 1;
		}

		$this->Template->lastUpdateUser = $arrHistory[$lastUpdatePosition]['name'];
		$this->Template->lastUpdateUserLabel = $GLOBALS['TL_LANG']['tl_task']['lastUpdateUser'];

		$this->Template->lastUpdateTime = $arrHistory[$lastUpdatePosition]['date'];
		$this->Template->lastUpdateTimeLabel = $GLOBALS['TL_LANG']['tl_task']['lastUpdateTime'];

		$this->Template->lastUpdateComment = $arrHistory[$lastUpdatePosition]['comment'];
		$this->Template->lastUpdateCommentLabel = $GLOBALS['TL_LANG']['tl_task']['comment'][0];

		$this->Template->history = $arrHistory;
		$this->Template->historyLabel = $GLOBALS['TL_LANG']['tl_task']['history'];
	}
		
	/**
	 * Delete a task
	 */
	protected function deleteTask()
	{
		$objTask = $this->Database->prepare("SELECT * FROM tl_task WHERE id=?")
								  ->limit(1)
								  ->execute($this->Input->get('id'));

		if ($objTask->numRows < 1)
		{
			$this->log('Invalid task ID "' . $this->Input->get('id') . '"', 'ModuleTask deleteTask()', TL_ERROR);
			$this->redirect('contao/main.php?act=error');
		}

		// Check if the user is allowed to delete the task
		if (!$this->User->isAdmin && $objTask->createdBy != $this->User->id)
		{
			$this->log('Not enough permissions to delete task ID "' . $this->Input->get('id') . '"', 'ModuleTask deleteTask()', TL_ERROR);
			$this->redirect('contao/main.php?act=error');
		}

		$affected = 1;
		$data = array();
		$data['tl_task'][] = $objTask->row();

		// Get status records
		$objStatus = $this->Database->prepare("SELECT * FROM tl_task_status WHERE pid=? ORDER BY tstamp")
									->execute($this->Input->get('id'));

		while ($objStatus->next())
		{
			$data['tl_task_status'][] = $objStatus->row();
			++$affected;
		}

		$objUndoStmt = $this->Database->prepare("INSERT INTO tl_undo (pid, tstamp, fromTable, query, affectedRows, data) VALUES (?, ?, ?, ?, ?, ?)")
									  ->execute($this->User->id, time(), 'tl_task', 'DELETE FROM tl_task WHERE id= ' . $this->Input->get('id'), $affected, serialize($data));

		// Delete data and add a log entry
		if ($objUndoStmt->affectedRows)
		{
			$this->Database->prepare("DELETE FROM tl_task WHERE id=?")->execute($this->Input->get('id'));
			$this->Database->prepare("DELETE FROM tl_task_status WHERE pid=?")->execute($this->Input->get('id'));

			$this->log('DELETE FROM tl_task WHERE id=' . $this->Input->get('id'), 'ModuleTask deleteTask()', TL_GENERAL);
		}

		// Go back
		$this->redirect($this->getReferer());
	}


	/**
	 * Select all tasks from the DB and return the result object
	 * @return object
	 */
	protected function getTaskObject()
	{
		$where = array();
		$value = array();

		$session = $this->Session->getData();
		$query = "SELECT *, t.id AS id, (SELECT name FROM tl_user u WHERE u.id=s.assignedTo) AS name, (SELECT name FROM tl_user u WHERE u.id=t.createdBy) AS creator, "
				. "(SELECT shortname FROM tl_task_project p WHERE p.id=t.project) AS projectName "
				. "FROM tl_task t LEFT JOIN tl_task_status s ON t.id=s.pid AND s.tstamp=(SELECT MAX(tstamp) FROM tl_task_status ts WHERE ts.pid=t.id)";

		// Do not show all tasks if the user is not an administrator
		if (!$this->User->isAdmin)
		{
			$where[] = "(t.createdBy=? OR s.assignedTo=?)";
			$value[] = $this->User->id;
			$value[] = $this->User->id;
		}

		// Set filter
		if ($this->Input->post('FORM_SUBMIT') == 'tl_filters')
		{
			// Search
			$session['search']['tl_task']['value'] = '';
			$session['search']['tl_task']['field'] = $this->Input->post('tl_field', true);
			
			// Sorting
			$session['sorting']['tl_task']['field'] = $this->Input->post('tl_sorting', true);
			
			// Make sure the regular expression is valid
			if ($this->Input->postRaw('tl_value') != '')
			{
				try
				{
					$this->Database->prepare("SELECT * FROM tl_task t LEFT JOIN tl_task_status s ON t.id=s.pid AND s.tstamp=(SELECT MAX(tstamp) FROM tl_task_status ts WHERE ts.pid=t.id) WHERE " . $this->Input->post('tl_field', true) . " REGEXP ?")
								   ->limit(1)
								   ->execute($this->Input->postRaw('tl_value'));

					$session['search']['tl_task']['value'] = $this->Input->postRaw('tl_value');
				}
				catch (Exception $e) {}
			}

			// Filter
			$session['filter']['tl_task']['id'] = $this->Input->post('id');
			$session['filter']['tl_task']['project'] = $this->Input->post('project');
			$session['filter']['tl_task']['tasktype'] = $this->Input->post('tasktype');
			$session['filter']['tl_task']['assignedTo'] = $this->Input->post('assignedTo');
			$session['filter']['tl_task']['priority'] = $this->Input->post('priority');
			$session['filter']['tl_task']['deadline'] = $this->Input->post('deadline');
			$session['filter']['tl_task']['status'] = $this->Input->post('status');
			$session['filter']['tl_task']['progress'] = $this->Input->post('progress');
			
			$this->Session->setData($session);
			$this->reload();
		}

		// Add search value to query
		if (strlen($session['search']['tl_task']['value']))
		{
			$where[] = "CAST(" . $session['search']['tl_task']['field'] . " AS CHAR) REGEXP ?";
			$value[] = $session['search']['tl_task']['value'];

			$this->Template->searchClass = ' active';
		}

		// Search options
		$fields = array('t.id', 'title', 'status', 'progress');
		$options = '';

		foreach ($fields as $field)
		{
			$options .= sprintf('<option value="%s"%s>%s</option>', $field, (($field == $session['search']['tl_task']['field']) ? ' selected="selected"' : ''), (is_array($GLOBALS['TL_LANG']['tl_task'][$field]) ? $GLOBALS['TL_LANG']['tl_task'][$field][0] : $GLOBALS['TL_LANG']['tl_task'][$field]));
		}

		$this->Template->searchOptions = $options;
		$this->Template->keywords = specialchars($session['search']['tl_task']['value']);
		$this->Template->search = specialchars($GLOBALS['TL_LANG']['MSC']['search']);

		// Sorting options
		$fields = array('t.id', 'projectName', 'tasktype', 'title', 'assignedTo', 'priority', 'status', 'progress', 'deadline');
		$options = '';

		foreach ($fields as $field)
		{
			$options .= sprintf('<option value="%s"%s>%s</option>', $field, (($field == $session['sorting']['tl_task']['field']) ? ' selected="selected"' : ''), (is_array($GLOBALS['TL_LANG']['tl_task'][$field]) ? $GLOBALS['TL_LANG']['tl_task'][$field][0] : $GLOBALS['TL_LANG']['tl_task'][$field]));
		}

		$this->Template->sortingOptions = $options;
		$this->Template->sorting = specialchars($GLOBALS['TL_LANG']['MSC']['sortBy']);

		// Add deadline value to query
		if (strlen($session['filter']['tl_task']['deadline']))
		{
			$objDate = new Date($session['filter']['tl_task']['deadline']);

			$where[] = "t.deadline BETWEEN ? AND ?";
			$value[] = $objDate->dayBegin;
			$value[] = $objDate->dayEnd;

			$this->Template->deadlineClass = ' active';
		}

		// Add id value to query
		if (strlen($session['filter']['tl_task']['id']))
		{
			$where[] = "t.id=?";
			$value[] = $session['filter']['tl_task']['id'];

			$this->Template->idClass = ' active';
		}
		
		// Add project value to query
		if (strlen($session['filter']['tl_task']['project']))
		{
			$where[] = "project=?";
			$value[] = $session['filter']['tl_task']['project'];

			$this->Template->projectClass = ' active';
		}
		
		// Add tasktype value to query
		if (is_array($session['filter']['tl_task']['tasktype']) && sizeof($session['filter']['tl_task']['tasktype']) > 0)
		{
			$whereString = "t.tasktype in (";
			foreach ($session['filter']['tl_task']['tasktype'] as $tasktype)
			{
				$whereString .= "?, ";
				$value[] = $tasktype;
			}

			$where[] = substr($whereString, 0, strlen($whereString) - 2) . ")";
			
			$this->Template->tasktypeClass = ' active';
		}
		
		// Add assignedTo value to query
		if (strlen($session['filter']['tl_task']['assignedTo']))
		{
			$where[] = "s.assignedTo=?";
			$value[] = $session['filter']['tl_task']['assignedTo'];

			$this->Template->assignedToClass = ' active';
		}
		
		// Add priority value to query
		if (is_array($session['filter']['tl_task']['priority']) && sizeof($session['filter']['tl_task']['priority']) > 0)
		{
			$whereString = "t.priority in (";
			foreach ($session['filter']['tl_task']['priority'] as $priority)
			{
				$whereString .= "?, ";
				$value[] = $priority;
			}

			$where[] = substr($whereString, 0, strlen($whereString) - 2) . ")";
			
			$this->Template->priorityClass = ' active';
		}
		
		// Add status value to query
		if (is_array($session['filter']['tl_task']['status']) && sizeof($session['filter']['tl_task']['status']) > 0)
		{
			$whereString = "s.status in (";
			foreach ($session['filter']['tl_task']['status'] as $status)
			{
				$whereString .= "?, ";
				$value[] = $status;
			}

			$where[] = substr($whereString, 0, strlen($whereString) - 2) . ")";
			
			$this->Template->statusClass = ' active';
		}
		
		// Add progress value to query
		if (strlen($session['filter']['tl_task']['progress']))
		{
			$where[] = "s.progress=?";
			$value[] = $session['filter']['tl_task']['progress'];
			
			$this->Template->progressClass = ' active';
		}

		// Filter options
		$objFilter = $this->Database->prepare("SELECT t.id, t.deadline, t.tasktype, t.priority, s.assignedTo, s.status, s.progress, (SELECT name FROM tl_user u WHERE u.id=s.assignedTo) AS assignedToName,"
											. " t.project, (SELECT shortname FROM tl_task_project p WHERE p.id=t.project) AS projectName FROM tl_task t "
											. "LEFT JOIN tl_task_status s ON t.id=s.pid AND s.tstamp=(SELECT MAX(tstamp) FROM tl_task_status ts WHERE ts.pid=t.id) ORDER BY id")
									->execute($value);

		$id = array();
		$project = array();
		$deadline = array();
		$tasktype = array();
		$priority = array();
		$assigned = array();
		$status = array();
		$progress = array();

		while ($objFilter->next())
		{
			$id[$objFilter->id] = sprintf('<option value="%s"%s>%s</option>', $objFilter->id, (($objFilter->id == $session['filter']['tl_task']['id']) ? ' selected="selected"' : ''), $objFilter->id);
			$project[$objFilter->project] = sprintf('<option value="%s"%s>%s</option>', $objFilter->project, (($objFilter->project == $session['filter']['tl_task']['project']) ? ' selected="selected"' : ''), $objFilter->projectName);
			$deadline[$objFilter->deadline] = sprintf('<option value="%s"%s>%s</option>', $objFilter->deadline, (($objFilter->deadline == $session['filter']['tl_task']['deadline']) ? ' selected="selected"' : ''), $this->parseDate($GLOBALS['TL_CONFIG']['dateFormat'], $objFilter->deadline));
			$tasktype[$objFilter->tasktype] = sprintf('<input type="checkbox" name="tasktype[]" id="tasktype_%s" value="%s" %s/> <label for="tasktype_%s">%s</label>', $objFilter->tasktype, $objFilter->tasktype, ((is_array($session['filter']['tl_task']['tasktype']) && in_array($objFilter->tasktype, $session['filter']['tl_task']['tasktype'])) ? ' checked="checked"' : ''), $objFilter->tasktype, $GLOBALS['TL_LANG']['tl_task_tasktype'][$objFilter->tasktype]);
			$priority[$objFilter->priority] = sprintf('<input type="checkbox" name="priority[]" id="priority_%s" value="%s" %s/> <label for="priority_%s">%s</label>', $objFilter->priority, $objFilter->priority, ((is_array($session['filter']['tl_task']['priority']) && in_array($objFilter->priority, $session['filter']['tl_task']['priority'])) ? ' checked="checked"' : ''), $objFilter->priority, $GLOBALS['TL_LANG']['tl_task_priority'][$objFilter->priority]);
			$assigned[$objFilter->assignedTo] = sprintf('<option value="%s"%s>%s</option>', $objFilter->assignedTo, (($objFilter->assignedTo == $session['filter']['tl_task']['assignedTo']) ? ' selected="selected"' : ''), $objFilter->assignedToName);
			$status[$objFilter->status] = sprintf('<input type="checkbox" name="status[]" id="status_%s" value="%s" %s/> <label for="status_%s">%s</label>', $objFilter->status, $objFilter->status, ((is_array($session['filter']['tl_task']['status']) && in_array($objFilter->status, $session['filter']['tl_task']['status'])) ? ' checked="checked"' : ''), $objFilter->status, $GLOBALS['TL_LANG']['tl_task_status'][$objFilter->status]);
			$progress[$objFilter->progress] = sprintf('<option value="%s"%s>%s</option>', $objFilter->progress, (($objFilter->progress == $session['filter']['tl_task']['progress']) ? ' selected="selected"' : ''), $objFilter->progress . '%');
		}

		$this->Template->idOptions = implode($id);
		$this->Template->projectOptions = implode($project);
		$this->Template->deadlineOptions = implode($deadline);
		$this->Template->assignedOptions = implode($assigned);
		$this->Template->statusOptions = implode($status);
		$this->Template->progressOptions = implode($progress);
		$this->Template->tasktypeOptions = implode($tasktype);
		$this->Template->priorityOptions = implode($priority);
		$this->Template->filter = specialchars($GLOBALS['TL_LANG']['MSC']['filter']);
		$this->Template->specialFilter = specialchars($GLOBALS['TL_LANG']['tl_task']['special_filter']);

		// Where
		if (count($where))
		{
			$query .= " WHERE " . implode(' AND ', $where);
		}
		
		// Order by
		$orderBy = $session['sorting']['tl_task']['field'];
		if (!strlen($orderBy)) {
			$orderBy = "title";
		}
		$query .= " ORDER BY " . $orderBy;
		
		$value[] = $this->User->id;

		// Execute query
		$objTask = $this->Database->prepare($query)->execute($value);

		if ($objTask->numRows < 1)
		{
			return null;
		}

		return $objTask;
	}

	/**
	 * Return the project widget as object
	 * @param mixed
	 * @return object
	 */
	protected function getProjectWidget($value=null)
	{
		$widget = new SelectMenu();

		$widget->id = 'project';
		$widget->name = 'project';
		$widget->mandatory = true;
		$widget->value = $value;

		$widget->label = $GLOBALS['TL_LANG']['tl_task']['project'][0];

		if ($GLOBALS['TL_CONFIG']['showHelp'] && strlen($GLOBALS['TL_LANG']['tl_task']['project'][1]))
		{
			$widget->help = $GLOBALS['TL_LANG']['tl_task']['project'][1];
		}

		$time = time();
		$arrOptions = array();
		$arrOptions[] = array('value'=>'', 'label'=>'-');

		// Get all active projects
		$objProject = $this->Database->execute("SELECT id, shortname, userGroups FROM tl_task_project WHERE published!=0 AND (start='' OR start<$time) AND (stop='' OR stop>$time)");

		while ($objProject->next())
		{
			// If the user is not an admin, show only projects of his groups
			if (!$this->User->isAdmin)
			{
				$groups = deserialize($objProject->userGroups, true);
				$intersect = array_intersect($this->User->groups, $groups);

				if (!is_array($intersect) || count($intersect) < 1)
				{
					continue;
				}
			}
			
			$arrOptions[] = array('value'=>$objProject->id, 'label'=>$objProject->shortname);
		}

		$widget->options = $arrOptions;

		// Valiate input
		if ($this->Input->post('FORM_SUBMIT') == 'tl_tasks')
		{
			$widget->validate();

			if ($widget->hasErrors())
			{
				$this->blnSave = false;
			}
		}

		return $widget;
	}
	
	
	/**
	 * Return the title widget as object
	 * @param mixed
	 * @return object
	 */
	protected function getTitleWidget($value=null)
	{
		$widget = new TextField();

		$widget->id = 'title';
		$widget->name = 'title';
		$widget->mandatory = true;
		$widget->decodeEntities = true;
		$widget->value = $value;

		$widget->label = $GLOBALS['TL_LANG']['tl_task']['title'][0];

		if ($GLOBALS['TL_CONFIG']['showHelp'] && strlen($GLOBALS['TL_LANG']['tl_task']['title'][1]))
		{
			$widget->help = $GLOBALS['TL_LANG']['tl_task']['title'][1];
		}

		// Valiate input
		if ($this->Input->post('FORM_SUBMIT') == 'tl_tasks')
		{
			$widget->validate();

			if ($widget->hasErrors())
			{
				$this->blnSave = false;
			}
		}

		return $widget;
	}


	/**
	 * Return the assignedTo widget as object
	 * @param mixed
	 * @return object
	 */
	protected function getAssignedToWidget($value=null)
	{
		$widget = new SelectMenu();

		$widget->id = 'assignedTo';
		$widget->name = 'assignedTo';
		$widget->mandatory = true;
		$widget->value = $value;

		$widget->label = $GLOBALS['TL_LANG']['tl_task']['assignTo'][0];

		if ($GLOBALS['TL_CONFIG']['showHelp'] && strlen($GLOBALS['TL_LANG']['tl_task']['assignTo'][1]))
		{
			$widget->help = $GLOBALS['TL_LANG']['tl_task']['assignTo'][1];
		}

		$time = time();
		$arrOptions = array();
		$arrOptions[] = array('value'=>'', 'label'=>'-');

		// Get all active users
		$objUser = $this->Database->execute("SELECT id, name, admin, groups FROM tl_user WHERE disable!=1 AND (start='' OR start<$time) AND (stop='' OR stop>$time)");

		while ($objUser->next())
		{
			// If the user is not an admin, show only users of his group
			if (!$this->User->isAdmin && !$objUser->admin)
			{
				$groups = deserialize($objUser->groups, true);
				$intersect = array_intersect($this->User->groups, $groups);

				if (!is_array($intersect) || count($intersect) < 1)
				{
					continue;
				}
			}

			$arrOptions[] = array('value'=>$objUser->id, 'label'=>$objUser->name);
		}

		$widget->options = $arrOptions;

		// Valiate input
		if ($this->Input->post('FORM_SUBMIT') == 'tl_tasks')
		{
			$widget->validate();

			if ($widget->hasErrors())
			{
				$this->blnSave = false;
			}
		}

		return $widget;
	}


	/**
	 * Return the deadline widget as object
	 * @param mixed
	 * @return object
	 */
	protected function getDeadlineWidget($value=null)
	{
		$widget = new TextField();

		$widget->id = 'deadline';
		$widget->name = 'deadline';
		$widget->mandatory = true;
		$widget->maxlength = 10;
		$widget->rgxp = 'date';
		$widget->datepicker = sprintf($this->getDatePickerString(), 'ctrl_deadline');
		$widget->value = $value;

		$widget->label = $GLOBALS['TL_LANG']['tl_task']['deadline'][0];

		if ($GLOBALS['TL_CONFIG']['showHelp'] && strlen($GLOBALS['TL_LANG']['tl_task']['deadline'][1]))
		{
			$widget->help = $GLOBALS['TL_LANG']['tl_task']['deadline'][1];
		}

		// Valiate input
		if ($this->Input->post('FORM_SUBMIT') == 'tl_tasks')
		{
			$widget->validate();

			if ($widget->hasErrors())
			{
				$this->blnSave = false;
			}
		}

		return $widget;
	}


	/**
	 * Return the status widget as object
	 * @param mixed
	 * @param integer
	 * @return object
	 */
	protected function getStatusWidget($value=null, $progress=null)
	{
		$widget = new SelectMenu();

		$widget->id = 'status';
		$widget->name = 'status';
		$widget->mandatory = true;
		$widget->value = $value;

		$widget->label = $GLOBALS['TL_LANG']['tl_task']['status'][0];

		if ($GLOBALS['TL_CONFIG']['showHelp'] && strlen($GLOBALS['TL_LANG']['tl_task']['status'][1]))
		{
			$widget->help = $GLOBALS['TL_LANG']['tl_task']['status'][1];
		}

		$arrOptions = array();

		// Get all active users
		foreach ($GLOBALS['TL_LANG']['tl_task_status'] as $k=>$v)
		{
			if ($k != 'created' || ($this->blnAdvanced && !$progress) || is_null($value))
			{
				$arrOptions[] = array('value'=>$k, 'label'=>$v);
			}
		}

		$widget->options = $arrOptions;

		// Valiate input
		if ($this->Input->post('FORM_SUBMIT') == 'tl_tasks')
		{
			$widget->validate();

			if ($widget->hasErrors())
			{
				$this->blnSave = false;
			}
		}

		return $widget;
	}
	
	/**
	 * Return the tasktype widget as object
	 * @param mixed
	 * @return object
	 */
	protected function getTasktypeWidget($value=null)
	{
		$widget = new SelectMenu();

		$widget->id = 'tasktype';
		$widget->name = 'tasktype';
		$widget->mandatory = true;
		$widget->value = $value;

		$widget->label = $GLOBALS['TL_LANG']['tl_task']['tasktype'][0];

		if ($GLOBALS['TL_CONFIG']['showHelp'] && strlen($GLOBALS['TL_LANG']['tl_task']['tasktype'][1]))
		{
			$widget->help = $GLOBALS['TL_LANG']['tl_task']['tasktype'][1];
		}

		$arrOptions = array();

		// Get all priorities
		foreach ($GLOBALS['TL_LANG']['tl_task_tasktype'] as $k=>$v)
		{
			$arrOptions[] = array('value'=>$k, 'label'=>$v);
		}

		$widget->options = $arrOptions;

		// Valiate input
		if ($this->Input->post('FORM_SUBMIT') == 'tl_tasks')
		{
			$widget->validate();

			if ($widget->hasErrors())
			{
				$this->blnSave = false;
			}
		}

		return $widget;
	}
	
	/**
	 * Return the priority widget as object
	 * @param mixed
	 * @return object
	 */
	protected function getPriorityWidget($value=null)
	{
		$widget = new SelectMenu();

		$widget->id = 'priority';
		$widget->name = 'priority';
		$widget->mandatory = true;
		$widget->value = $value;

		$widget->label = $GLOBALS['TL_LANG']['tl_task']['priority'][0];

		if ($GLOBALS['TL_CONFIG']['showHelp'] && strlen($GLOBALS['TL_LANG']['tl_task']['priority'][1]))
		{
			$widget->help = $GLOBALS['TL_LANG']['tl_task']['priority'][1];
		}

		$arrOptions = array();

		// Get all priorities
		foreach ($GLOBALS['TL_LANG']['tl_task_priority'] as $k=>$v)
		{
			$arrOptions[] = array('value'=>$k, 'label'=>$v);
		}

		$widget->options = $arrOptions;

		// Valiate input
		if ($this->Input->post('FORM_SUBMIT') == 'tl_tasks')
		{
			$widget->validate();

			if ($widget->hasErrors())
			{
				$this->blnSave = false;
			}
		}

		return $widget;
	}

	/**
	 * Return the progress widget as object
	 * @param mixed
	 * @return object
	 */
	protected function getProgressWidget($value=null)
	{
		$widget = new SelectMenu();

		$widget->id = 'progress';
		$widget->name = 'progress';
		$widget->mandatory = true;
		$widget->value = $value;

		$widget->label = $GLOBALS['TL_LANG']['tl_task']['progress'][0];

		if ($GLOBALS['TL_CONFIG']['showHelp'] && strlen($GLOBALS['TL_LANG']['tl_task']['progress'][1]))
		{
			$widget->help = $GLOBALS['TL_LANG']['tl_task']['progress'][1];
		}

		$arrOptions = array();
		$arrProgress = array(0,10,20,30,40,50,60,70,80,90,100);

		// Get all active users
		foreach ($arrProgress as $v)
		{
			$arrOptions[] = array('value'=>$v, 'label'=>$v . '%');
		}

		$widget->options = $arrOptions;

		// Valiate input
		if ($this->Input->post('FORM_SUBMIT') == 'tl_tasks')
		{
			$widget->validate();

			if ($widget->hasErrors())
			{
				$this->blnSave = false;
			}
		}

		return $widget;
	}


	/**
	 * Return the comment widget as object
	 * @param mixed
	 * @return object
	 */
	protected function getCommentWidget($value=null)
	{
		$this->loadDataContainer('tl_task');
 
		$widget = new TextArea();

		$widget->id = 'comment';
		$widget->name = 'comment';
		$widget->mandatory = true;
		$widget->decodeEntities = true;
		$widget->explanation = 'insertTags';
		$widget->allowHtml = true;
		$widget->style = 'height:120px;';
		$widget->value = $value;
		$widget->strTable = 'tl_task';
		$widget->strField = 'comment';
		$widget->rte = $GLOBALS['TL_DCA'][$widget->strTable]['fields'][$widget->strField]['eval']['rte'];

		$widget->label = $GLOBALS['TL_LANG']['tl_task']['comment'][0];

		if ($GLOBALS['TL_CONFIG']['showHelp'] && strlen($GLOBALS['TL_LANG']['tl_task']['comment'][1]))
		{
			$widget->help = $GLOBALS['TL_LANG']['tl_task']['comment'][1];
		}

		// Valiate input
		if ($this->Input->post('FORM_SUBMIT') == 'tl_tasks')
		{
			$widget->validate();

			if ($widget->hasErrors())
			{
				$this->blnSave = false;
			}
		}

		return $widget;
	}


	/**
	 * Return the notify widget as object
	 * @return object
	 */
	protected function getNotifyWidget()
	{
		$widget = new CheckBox();

		$widget->id = 'notify';
		$widget->name = 'notify';
		
		$value = 1;
		if ($GLOBALS['TL_CONFIG']['taskCenterExtended_NotifyUserDefault']) {
			$value = 0;
		}

		$widget->options = array(array('value'=>$value, 'label'=>$GLOBALS['TL_LANG']['tl_task']['notify'][0]));

		if ($GLOBALS['TL_CONFIG']['showHelp'] && strlen($GLOBALS['TL_LANG']['tl_task']['notify'][1]))
		{
			$widget->help = $GLOBALS['TL_LANG']['tl_task']['notify'][1];
		}

		return $widget;
	}
}

?>