<?php

/**
 * Contao Open Source CMS
 *
 * @copyright  Leo Feyer 2005-2012
 * @copyright  Cliff Parnitzky 2013
 * @package    Tasks
 * @license    LGPL
 */

/**
 * Load tl_task_status language file
 */
$this->loadLanguageFile('tl_task_status');

/**
 * Table tl_task_status
 */
$GLOBALS['TL_DCA']['tl_task_status'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'ptable'                      => 'tl_task',
		'onload_callback' => array
		(
			// TODO add checkPersmission
			//array('tl_task', 'checkPersmission'),
			array('tl_task_status', 'loadTaskStatus')
		),
		'onsubmit_callback' => array
		(
			array('tl_task_status', 'updateTaskValuesWhenStoring'),
			array('tl_task_status', 'sendMailWhenStoring')
		),
		'ondelete_callback' => array
		(
			array('tl_task_status', 'updateTaskValuesWhenDeleting'),
			array('tl_task_status', 'sendMailWhenDeleting')
		),
		'sql' => array
		(
			'keys' => array
			(
				'id' => 'primary',
				'pid' => 'index',
			)
		),
	),

	// Listing
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 4,
			'fields'                  => array('createdAt', 'createdBy', 'status', 'progress', 'assignedTo', 'comment'),
			'flag'                    => 5,
			'headerFields'            => array('tasktitle', 'createdAt', 'createdBy', 'tasktype', 'priority', 'deadline', 'description', 'status', 'progress', 'assignedTo'),
			'child_record_callback'   => array('tl_task_status', 'buildTaskStatus'),
			'header_callback'         => array('tl_task_status', 'buildTaskHeader'),
			'panelLayout'             => 'filter;sort,search,limit'
		),
		'operations' => array
		(
			'edit' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_task_status']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif',
				//'button_callback'     => array('tl_task', 'createTaskStatus'), // TODO check if the user is allowed to edit
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_task_status']['show'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"',
				//'button_callback'     => array('tl_task', 'createTaskStatus'), // TODO check if the user is allowed to delete
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_task_status']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif',
				//'button_callback'     => array('tl_task', 'createTaskStatus'), // TODO check if the user is allowed to show
			)
		),
	),

	// Palettes
	'palettes' => array
	(
		'default'                   => '{task_legend},task_title,task_description;{state_legend},status,progress;{assign_legend},assignedTo;{comment_legend},comment;',
	),

	// Fields
	'fields' => array
	(
		'id' => array
		(
			'eval'                    => array('doNotShow'=>true),
			'sql'                     => "int(10) unsigned NOT NULL auto_increment"
		),
		'pid' => array
		(
			'eval'                    => array('doNotShow'=>true),
			'foreignKey'              => 'tl_task.id',
			'sql'                     => "int(10) unsigned NOT NULL default '0'",
			'relation'                => array('type'=>'belongsTo', 'load'=>'eager')
		),
		'tstamp' => array
		(
			'eval'                    => array('doNotShow'=>true),
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'createdAt' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_task_status']['createdAt'],
			'filter'                  => true,
			'search'                  => true,
			'sorting'                 => true,
			'flag'                    => 5,
			'default'                 => time(),
			'eval'                    => array('doNotCopy'=>true, 'rgxp'=>'datim'),
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'createdBy' => array
		(
		 	'label'                   => &$GLOBALS['TL_LANG']['tl_task_status']['createdBy'],
			'filter'                  => true,
			'search'                  => true,
			'sorting'                 => true,
			'default'                 => $this->User->id,
			'foreignKey'              => 'tl_user.name',
			'eval'                    => array('doNotCopy'=>true),
			'sql'                     => "int(10) unsigned NOT NULL default '0'",
			'relation'                => array('type'=>'hasOne', 'load'=>'eager')
		),
		'task_title' => array
		(
			'input_field_callback'    => array('tl_task_status', 'getTaskTitle')
		),
		'task_description' => array
		(
			'input_field_callback'    => array('tl_task_status', 'getTaskDescription')
		),
		'status' => array
		(
		 	'label'                   => &$GLOBALS['TL_LANG']['tl_task_status']['status'],
			'exclude'                 => true,
			'filter'                  => true,
			'search'                  => true,
			'sorting'                 => true,
			'inputType'               => 'select',
			'options_callback'        => array('tl_task_status', 'getStatusOptions'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_task_status']['status_values'],
		 	'eval'                    => array('mandatory'=>true, 'includeBlankOption'=>true, 'tl_class'=>'w50', 'helpwizard'=>true),
			'sql'                     => "varchar(32) NOT NULL",
		),
		'progress' => array
		(
		 	'label'                   => &$GLOBALS['TL_LANG']['tl_task_status']['progress'],
			'exclude'                 => true,
			'filter'                  => true,
			'search'                  => true,
			'sorting'                 => true,
			'inputType'               => 'select',
			'options_callback'        => array('tl_task_status', 'getProgressOptions'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_task_status']['progress_values'],
		 	'eval'                    => array('mandatory'=>true, 'tl_class'=>'w50'),
			'sql'                     => "smallint(5) unsigned NOT NULL",
		),
		'assignedTo' => array
		(
		 	'label'                   => &$GLOBALS['TL_LANG']['tl_task_status']['assignedTo'],
			'exclude'                 => true,
			'inputType'               => 'select',
		 	'default'                 => null,
		 	'foreignKey'              => 'tl_user.name',
			'eval'                    => array('chosen'=>true, 'includeBlankOption'=>true, 'tl_class'=>'w50'),
			'relation'                => array('type'=>'hasOne', 'load'=>'eager'),
			'sql'                     => "int(10) unsigned NULL",
		),
		'comment' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_task_status']['comment'],
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'flag'                    => 1,
			'inputType'               => 'textarea',
			'eval'                    => array('tl_class'=>'clr', 'rte'=>'tinyTask'),
			'sql'                     => "text NULL"
		)
	)
);

/**
 * Class tl_task_status
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 */
class tl_task_status extends Backend
{
	/**
	 * Import the back end user object
	 */
	public function __construct()
	{
		parent::__construct();
		$this->import('BackendUser', 'User');
	}

	/**
	 * Edit the task header ... modify fields
	 * @param  $arrHeaderFields  the headerfields given from list->sorting
	 * @param  Datacontainer $dc a Datacontainer Object
	 * @return Array             The manipulated headerfields
	 */
	public function buildTaskHeader($arrHeaderFields, Datacontainer $dc)
	{
		$taskId = (int) $dc->id;
		
		if (isset($GLOBALS['TL_HOOKS']['tasksModifyTaskStatusHeaderFields']) && is_array($GLOBALS['TL_HOOKS']['tasksModifyTaskStatusHeaderFields']))
		{
			foreach ($GLOBALS['TL_HOOKS']['tasksModifyTaskStatusHeaderFields'] as $callback)
			{
				$this->import($callback[0]);
				$arrHeaderFields = $this->$callback[0]->$callback[1]($arrHeaderFields, $taskId);
			}
		}

		return $arrHeaderFields;
	}
	
	/**
	 * Edit a task status ... adding fields
	 * @param array
	 * @return string
	 */
	public function buildTaskStatus($arrRow)
	{
		$blnAddedData = false;
		$return = ' <span class="tl_gray">' . date($GLOBALS['TL_CONFIG']['datimFormat'], $arrRow['tstamp']) . ' - ' . UserModel::findOneById($arrRow['createdBy'])->name . '</span>';
		
		$tableRows = array();
		foreach ($GLOBALS['TL_DCA']['tl_task_status']['list']['sorting']['fields'] as $field)
		{
			$label = $field;
			if(is_string($GLOBALS['TL_LANG']['tl_task_status'][$field]))
			{
				$label = $GLOBALS['TL_LANG']['tl_task_status'][$field];
			}
			elseif(is_array($GLOBALS['TL_LANG']['tl_task_status'][$field]))
			{
				$label = $GLOBALS['TL_LANG']['tl_task_status'][$field][0];
			}
			$tableRows[$field] = array('label' => $label, 'value' => $arrRow[$field], 'valueFormatted' => $arrRow[$field]);
		}
		
		if (isset($GLOBALS['TL_HOOKS']['tasksModifyTaskStatusTableRows']) && is_array($GLOBALS['TL_HOOKS']['tasksModifyTaskStatusTableRows']))
		{
			foreach ($GLOBALS['TL_HOOKS']['tasksModifyTaskStatusTableRows'] as $callback)
			{
				$this->import($callback[0]);
				$tableRows = $this->$callback[0]->$callback[1]($tableRows);
			}
		}
		
		$return .= '<table class="updated">';
		foreach($tableRows as $key=>$tableRow)
		{
			$return .= '<tr' . (strlen($tableRow['css']['row_class']) > 0 ? ' class="' . $tableRow['css']['row_class'] . '"' : '')  . '><td><span class="tl_label">' . $tableRow['label'] . ':<span></td><td>' . $tableRow['valueFormatted'] . '</td></tr>';
			$blnAddedData = true;
		}
		$return .= '</table>';

		if (!$blnAddedData)
		{
			return $GLOBALS['TL_LANG']['TaskCenter']['nothingChanged'];
		}
		return $return;
	}
	
	/**
	 * Returning the status options.
	 */
	public function getStatusOptions(DataContainer $dc)
	{
		$statusOptions = array();
		
		if (is_array($GLOBALS['TL_LANG']['tl_task_status']['status_values']))
		{
			foreach($GLOBALS['TL_LANG']['tl_task_status']['status_values'] as $k=>$v)
			{
				$statusOptions[$k] = $v[0];
			}
		}
		
		if (isset($GLOBALS['TL_HOOKS']['tasksModifyStatusOptions']) && is_array($GLOBALS['TL_HOOKS']['tasksModifyStatusOptions']))
		{
			foreach ($GLOBALS['TL_HOOKS']['tasksModifyStatusOptions'] as $callback)
			{
				$this->import($callback[0]);
				$statusOptions = $this->$callback[0]->$callback[1]($statusOptions, $dc->activeRecord->pid);
			}
		} 
		return $statusOptions;
	}
	
	/**
	 * Returning the progress options.
	 */
	public function getProgressOptions(DataContainer $dc)
	{
		$progressOptions = array();
		
		if (is_array($GLOBALS['TL_LANG']['tl_task_status']['progress_values']))
		{
			foreach($GLOBALS['TL_LANG']['tl_task_status']['progress_values'] as $k=>$v)
			{
				$progressOptions[$k] = $v;
			}
		}
		
		if (isset($GLOBALS['TL_HOOKS']['tasksModifyProgressOptions']) && is_array($GLOBALS['TL_HOOKS']['tasksModifyProgressOptions']))
		{
			foreach ($GLOBALS['TL_HOOKS']['tasksModifyProgressOptions'] as $callback)
			{
				$this->import($callback[0]);
				$progressOptions = $this->$callback[0]->$callback[1]($progressOptions, $dc->activeRecord->pid);
			}
		} 
		return $progressOptions;
	}
	
	/**
	 * Setting the task defaults when loading a new task status (to keep them).
	 */
	public function loadTaskStatus ()
	{
		if (Input::get('act') != 'create')
		{
			return;
		}
		$taskId = $this->getCurrentTaskId();
		$GLOBALS['TL_DCA']['tl_task_status']['fields']['status']['default'] = TaskModel::getCurrentTaskById($taskId)->status;
		$GLOBALS['TL_DCA']['tl_task_status']['fields']['progress']['default'] = TaskModel::getCurrentTaskById($taskId)->progress;
		$GLOBALS['TL_DCA']['tl_task_status']['fields']['assignedTo']['default'] = TaskModel::getCurrentTaskById($taskId)->assignedTo;
	}
	
	/**
	 * Update the task values (status, progress, assignedTo) when storing a new task status
	 *
	 * This method is triggered when task status is stored, to propagate the task values
	 * @param \DataContainer
	 */
	public function updateTaskValuesWhenStoring(DataContainer $dc)
	{
		$isNew = $dc->activeRecord->tstamp == 0;
		if ($isNew)
		{
			$this->updateTaskValues($this->getCurrentTaskId(), $dc->activeRecord->status, $dc->activeRecord->progress, $dc->activeRecord->assignedTo);
		}
		else
		{
			$this->updateTaskValuesToLastActiveTaskStatusValues($dc);
		}
	} 
	
	/**
	 * Update the task values (status, progress, assignedTo) when storing a new task status
	 *
	 * This method is triggered when task status is stored, to propagate the task values
	 * @param \DataContainer
	 */
	public function updateTaskValuesWhenDeleting(DataContainer $dc)
	{
		$this->updateTaskValuesToLastActiveTaskStatusValues($dc);
	}
	
	/**
	 * Updates the task values to the values of the last active task status
	 */
	private function updateTaskValuesToLastActiveTaskStatusValues(DataContainer $dc)
	{
		$objTaskStatus = \TaskModel::getLastActiveTaskStatusForTask($this->getCurrentTaskId(), $dc->id);
		
		if ($objTaskStatus != null)
		{
			$this->updateTaskValues($this->getCurrentTaskId(), $objTaskStatus->status, $objTaskStatus->progress, $objTaskStatus->assignedTo);
		}
		else
		{
			// TODO check ... task status will be deleted after this callback
			$this->updateTaskValues($this->getCurrentTaskId(), TaskModel::getDefaultValue('status'), TaskModel::getDefaultValue('progress'), TaskModel::getDefaultValue('assignedUser'));
		}
	}
	
	/**
	 * Updates the task values.
	 */
	private function updateTaskValues($taskId, $status, $progress, $assignedTo)
	{
		$objTask = \TaskModel::findByPk($taskId);
		$objTask->status = $status;
		$objTask->progress = $progress;
		$objTask->assignedTo = $assignedTo;
		$objTask->save();
	}
	
	/**
	 * Send a mail when storing a task status
	 *
	 * @param \DataContainer
	 */
	public function sendMailWhenStoring(DataContainer $dc)
	{
		$isNew = $dc->activeRecord->tstamp == 0;
		TaskMailer::getInstance()->sendTaskStatusMail($this->getCurrentTaskId(), $dc->id, $isNew ? TaskMailer::CREATED : TaskMailer::UPDATED);
	} 
	
	/**
	 * Send a mail when deleting a task status
	 *
	 * @param \DataContainer
	 */
	public function sendMailWhenDeleting(DataContainer $dc)
	{
		TaskMailer::getInstance()->sendTaskStatusMail($this->getCurrentTaskId(), $dc->id, TaskMailer::DELETED);
	}
	
	/**
	 * Getting the tasks description to show it on top.
	 */
	public function getTaskTitle(DataContainer $dc)
	{
		$task = TaskModel::getCurrentTaskById($this->getCurrentTaskId());
		$tasktitle = '';
		if ($task !=null)
		{
			$tasktitle = $task->tasktitle;
		}
		
		return '
<div class="clr">
	<h3><label>' . $GLOBALS['TL_LANG']['tl_task_status']['task_title'][0] . '</label></h3>
	<div class="tl_textarea" style="height: 16px; overflow: hidden;">' . $tasktitle . '</div>
	<p class="tl_help tl_tip" title="">' . $GLOBALS['TL_LANG']['tl_task_status']['task_title'][1] . '</p>
</div>';
	}
	
	/**
	 * Getting the tasks description to show it on top.
	 */
	public function getTaskDescription(DataContainer $dc)
	{
		$task = TaskModel::getCurrentTaskById($this->getCurrentTaskId());
		$description = '';
		if ($task !=null)
		{
			$description = $task->description;
		}
		
		return '
<div class="clr">
	<h3><label>' . $GLOBALS['TL_LANG']['tl_task_status']['task_description'][0] . '</label></h3>
	<div class="tl_textarea" style="height: 120px; overflow: auto;">' . $description . '</div>
	<p class="tl_help tl_tip" title="">' . $GLOBALS['TL_LANG']['tl_task_status']['task_description'][1] . '</p>
</div>';
	}
	
	/**
	 * Returns the id of the current task
	 */
	private function getCurrentTaskId()
	{
		if (Input::get('pid'))
		{
			return Input::get('pid');
		}
		return CURRENT_ID;
	}
}

?>