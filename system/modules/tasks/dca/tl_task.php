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
 * Load tl_task language file
 */
$this->loadLanguageFile('tl_task');
$this->loadLanguageFile('tl_task_status');

/**
 * Table tl_task
 */
$GLOBALS['TL_DCA']['tl_task'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'ctable'                      => array('tl_task_status'),
		'switchToEdit'                => true,
		'enableVersioning'            => true,
		'onload_callback' => array
		(
			// TODO add checkPersmission
			//array('tl_task', 'checkPersmission')
		),
		'onsubmit_callback' => array
		(
			array('tl_task', 'setDefaultTaskValues'),
			array('tl_task', 'sendMailWhenStoring')
		),
		'ondelete_callback' => array
		(
			array('tl_task', 'sendMailWhenDeleting')
		),
		'sql' => array
		(
			'keys' => array
			(
				'id' => 'primary',
			)
		),
	),

	// Listing
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 2,
			'fields'                  => array('deadline'),
			'panelLayout'             => 'filter;sort,search,limit',
			'filter'                  => TaskFilter::getAllFilterDefinitions()
		),
		'label' => array
		(
			'fields'                  => array('id', 'tasktitle', 'createdAt', 'tasktype', 'priority', 'deadline', 'status', 'progress', 'assignedTo'),
			'showColumns'             => true,
			'label_callback'          => array('tl_task', 'buildTableRow')
		),
		'global_operations' => array
		(
			'filter' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_task']['specialFilter'],
				'class'               => 'header_special_filter',
				'button_callback'     => array('tl_task', 'getSpecialFilterDropDown') 
			)
		),
		'operations' => array
		(
			'edit' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_task']['edit'], 
				'href'                => 'table=tl_task_status&act=create&mode=2',
				'icon'                => 'edit.gif',
				'button_callback'     => array('tl_task', 'createTaskStatus'),
			),
			'edit_history' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_task']['edit_history'], 
				'href'                => 'table=tl_task_status',
				'icon'                => 'system/modules/tasks/html/icon_edit_history.png',
			),
			'editheader' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_task']['editheader'],
				'href'                => 'act=edit',
				'icon'                => 'header.gif',
				//'button_callback'     => array('tl_task', 'editTaskStatus'),
				//'button_callback'     => array('tl_task', 'editHeader')
				'button_callback'     => array('tl_task', 'deleteTask'),
			), 
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_task']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"',
				'button_callback'     => array('tl_task', 'deleteTask'),
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_task']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif',
			)
		),
	),

	// Palettes
	'palettes' => array
	(
		'default'                     => '{taskdata_legend},tasktitle,tasktype,priority;{dates_legend},deadline;{description_legend},description;',
	),

	// Fields
	'fields' => array
	(
		'id' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_task']['id'],
			'filter'                  => true,
			'sorting'                 => true,
			'flag'                    => 1,
			'sql'                     => "int(10) unsigned NOT NULL auto_increment"
		),
		'tstamp' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'tasktitle' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_task']['tasktitle'],
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'flag'                    => 1,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'long'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'createdAt' => array
		(
		 	'label'                   => &$GLOBALS['TL_LANG']['tl_task']['createdAt'],
			'default'                 => time(),
			'filter'                  => true,
			'sorting'                 => true,
			'flag'                    => 5,
			'eval'                    => array('doNotCopy'=>true, 'rgxp'=>'datim', 'datepicker'=>true, 'tl_class'=>'w50 wizard'),
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'createdBy' => array
		(
		 	'label'                   => &$GLOBALS['TL_LANG']['tl_task']['createdBy'],
			'default'                 => $this->User->id,
			'filter'                  => true,
			'sorting'                 => true,
			'flag'                    => 11,
			'foreignKey'              => 'tl_user.name',
			'eval'                    => array('doNotCopy'=>true, 'chosen'=>true, 'mandatory'=>true, 'includeBlankOption'=>true, 'tl_class'=>'w50'),
			'sql'                     => "int(10) unsigned NOT NULL default '0'",
			'relation'                => array('type'=>'hasOne', 'load'=>'eager')
		),
		'tasktype' => array
		(
		 	'label'                   => &$GLOBALS['TL_LANG']['tl_task']['tasktype'],
			'exclude'                 => true,
			'filter'                  => true,
			'sorting'                 => true,
			'flag'                    => 1,
			'inputType'               => 'select',
			'default'                 => TaskModel::getDefaultValue('tasktype'),
			'options_callback'        => array('tl_task', 'getTasktypeOptions'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_task']['tasktype_values'],
		 	'eval'                    => array('mandatory'=>true, 'tl_class'=>'clr w50'),
			'sql'                     => "varchar(32) NOT NULL"
		),
		'priority' => array
		(
		 	'label'                   => &$GLOBALS['TL_LANG']['tl_task']['priority'],
			'exclude'                 => true,
			'filter'                  => true,
			'sorting'                 => true,
			'flag'                    => 12,
			'inputType'               => 'select',
			'default'                 => TaskModel::getDefaultValue('priority'),
			'options_callback'        => array('tl_task', 'getPriorityOptions'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_task']['priority_values'],
		 	'eval'                    => array('mandatory'=>true, 'tl_class'=>'w50'),
			'sql'                     => "smallint(1) NOT NULL"
		),
		'deadline' => array
		(
		 	'label'                   => &$GLOBALS['TL_LANG']['tl_task']['deadline'],
		 	'exclude'                 => true,
			'filter'                  => true,
			'sorting'                 => true,
			'flag'                    => 5,
		 	'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'datim', 'mandatory'=>true, 'datepicker'=>true, 'tl_class'=>'w50 wizard'), 
			'sql'                     => "int(10) unsigned NULL"
		),
		'description' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_task']['description'],
			'exclude'                 => true,
			'search'                  => true,
			'flag'                    => 1,
			'inputType'               => 'textarea',
			'eval'                    => array('mandatory'=>true, 'rte'=>'tinyTask', 'tl_class'=>'clr'),
			'sql'                     => "text NULL"
		),
		'status' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_task']['status'],
			'filter'                  => true,
			'sorting'                 => true,
			'inputType'               => 'select',
			'options_callback'        => array('tl_task_status', 'getStatusOptions'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_task_status']['status_values'],
			'sql'                     => "varchar(32) NOT NULL"
		),
		'progress' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_task']['progress'],
			'filter'                  => true,
			'sorting'                 => true,
			'inputType'               => 'select',
			'options_callback'        => array('tl_task_status', 'getProgressOptions'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_task_status']['progress_values'],
			'sql'                     => "smallint(5) unsigned NOT NULL"
		),
		'assignedTo' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_task']['assignedTo'],
			'filter'                  => true,
			'sorting'                 => true,
			'inputType'               => 'select',
		 	'foreignKey'              => 'tl_user.name',
			'relation'                => array('type'=>'hasOne', 'load'=>'eager'),
			'sql'                     => "int(10) unsigned NOT NULL"
		)
	),
);

/**
 * Class tl_task
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 */
class tl_task extends Backend
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
	 * Return the edit task status
	 * @param array
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @return string
	 */
	public function createTaskStatus($row, $href, $label, $title, $icon, $attributes)
	{
		return '<a href="'.$this->addToUrl($href.'&amp;pid='.$row['id']).'" title="'.specialchars($title).'"'.$attributes.'>'.$this->generateImage($icon, $label).'</a> ';
	}

	/**
	 * Return the edit task status
	 * @param array
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @return string
	 */
	public function editTaskStatus($row, $href, $label, $title, $icon, $attributes)
	{
		return '<a href="'.$this->addToUrl($href.'&amp;id='.$row['id']).'" title="'.specialchars($title).'"'.$attributes.'>'.$this->generateImage($icon, $label).'</a> ';
	}

	/**
	 * Return the edit task button
	 * @param array
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @return string
	 */
	public function editTask($row, $href, $label, $title, $icon, $attributes)
	{
		return ($this->User->isAdmin || $this->User->id == $row['createdBy'] || $this->User->hasAccess('modules', 'tasks')) ? '<a href="'.$this->addToUrl($href.'&amp;id='.$row['id']).'" title="'.specialchars($title).'"'.$attributes.'>'.$this->generateImage($icon, $label).'</a> ' :  '';
	}

	/**
	 * Return the delete task button
	 * @param array
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @return string
	 */
	public function deleteTask($row, $href, $label, $title, $icon, $attributes)
	{
		return ($this->User->isAdmin || $this->User->id == $row['createdBy'] || $this->User->hasAccess('modules', 'tasks')) ? '<a href="'.$this->addToUrl($href.'&amp;id='.$row['id']).'" title="'.specialchars($title).'"'.$attributes.'>'.$this->generateImage($icon, $label).'</a> ' :  '';
	}

	/**
	 * format labels
	 * @param array
	 * @param string
	 * @param \DataContainer
	 * @param array
	 * @return string
	 */
	public function buildTableRow($row, $label, DataContainer $dc, $args)
	{
		if (isset($GLOBALS['TL_HOOKS']['tasksModifyTaskTableRow']) && is_array($GLOBALS['TL_HOOKS']['tasksModifyTaskTableRow']))
		{
			foreach ($GLOBALS['TL_HOOKS']['tasksModifyTaskTableRow'] as $callback)
			{
				$this->import($callback[0]);
				$args = $this->$callback[0]->$callback[1]($args, $row);
			}
		}
		
		return $args;
	}
	
	/**
	 * Returning the tasktype options.
	 */
	public function getTasktypeOptions(DataContainer $dc)
	{
		$options = array();
		
		if (is_array($GLOBALS['TL_LANG']['tl_task']['tasktype_values']))
		{
			foreach($GLOBALS['TL_LANG']['tl_task']['tasktype_values'] as $k=>$v)
			{
				$options[$k] = $v;
			}
		}
		
		if (isset($GLOBALS['TL_HOOKS']['tasksModifyTasktypeOptions']) && is_array($GLOBALS['TL_HOOKS']['tasksModifyTasktypeOptions']))
		{
			foreach ($GLOBALS['TL_HOOKS']['tasksModifyTasktypeOptions'] as $callback)
			{
				$this->import($callback[0]);
				$options = $this->$callback[0]->$callback[1]($options, $dc->activeRecord->id);
			}
		} 
		return $options;
	}
	
	/**
	 * Returning the priority options.
	 */
	public function getPriorityOptions(DataContainer $dc)
	{
		$options = array();
		
		if (is_array($GLOBALS['TL_LANG']['tl_task']['priority_values']))
		{
			foreach($GLOBALS['TL_LANG']['tl_task']['priority_values'] as $k=>$v)
			{
				$options[$k] = $v;
			}
		}
		
		if (isset($GLOBALS['TL_HOOKS']['tasksModifyPriorityOptions']) && is_array($GLOBALS['TL_HOOKS']['tasksModifyPriorityOptions']))
		{
			foreach ($GLOBALS['TL_HOOKS']['tasksModifyPriorityOptions'] as $callback)
			{
				$this->import($callback[0]);
				$options = $this->$callback[0]->$callback[1]($options, $dc->activeRecord->id);
			}
		} 
		return $options;
	}
	
	/**
	 * Returning the drop down for the special filter
	 */
	public function getSpecialFilterDropDown($href, $label, $title, $class, $attributes)
	{
		return TaskFilter::getSpecialFilterDropDown($this->addToUrl(''), $label, $class);
	}
	
	/**
	 * Set the default task values if it is created
	 *
	 * @param \DataContainer
	 */
	public function setDefaultTaskValues(DataContainer $dc)
	{
		$isNew = $dc->activeRecord->tstamp == 0;
		if ($isNew)
		{
			$objTask = \TaskModel::findByPk($dc->id);
			$objTask->status = TaskModel::getDefaultValue('status');
			$objTask->progress = TaskModel::getDefaultValue('progress');
			$objTask->assignedTo = TaskModel::getDefaultValue('assignedUser');
			$objTask->save();
		}
	} 
	
	/**
	 * Send a mail when storing a task
	 *
	 * @param \DataContainer
	 */
	public function sendMailWhenStoring(DataContainer $dc)
	{
		$isNew = $dc->activeRecord->tstamp == 0;
		TaskMailer::getInstance()->sendTaskMail($dc->id, $isNew ? TaskMailer::CREATED : TaskMailer::UPDATED);
	} 
	
	/**
	 * Send a mail when deleting a task
	 *
	 * @param \DataContainer
	 */
	public function sendMailWhenDeleting(DataContainer $dc)
	{
		TaskMailer::getInstance()->sendTaskMail($dc->id, TaskMailer::DELETED);
	}
}

?>