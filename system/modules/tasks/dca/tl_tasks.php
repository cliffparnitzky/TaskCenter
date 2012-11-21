<?php

/**
 * Load tl_task language file
 */
$this->loadLanguageFile('tl_task');

/**
 * Table tl_tasks
 */
$GLOBALS['TL_DCA']['tl_tasks'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'ctable'                      => array('tl_task_status'),
		'switchToEdit'                => true,
		'enableVersioning'            => true,
		'sql' => array
		(
			'keys' => array
			(
				'id' => 'primary',
			)
		),
	),

	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 1,
			'fields'                  => array('deadline'),
			'flag'                    => 11,
			'panelLayout'             => 'sort,search,limit'
		),
		'label' => array
		(
			'fields'                  => array('title' , 'assignedTo', 'progress', 'createdAt', 'deadline'),
			'showColumns'             => true,
			'label_callback'          => array('tl_task', 'editLabel')
		),
		'operations' => array
		(
			'edit' => array
			(			
				'href'                => 'table=tl_task_status',
				'icon'                => 'edit.gif',
				'attributes'          => 'class="contextmenu"',
				'button_callback'     => array('tl_task', 'editTaskStatus'),
			),
			'delete' => array
			(
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"',
				'button_callback'     => array('tl_task', 'editTask'),
			),
		),
	),

	// Palettes
	'palettes' => array
	(
		'default'                     => '{title_legend},title;{timing_legend},deadline;{description_legend},description;',
	),

	// Fields
	'fields' => array
	(
		'id' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL auto_increment"
		),
		'tstamp' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'title' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_task']['title'],
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'flag'                    => 1,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'long'),
			'sql'                     => "varchar(255) NOT NULL default ''",
		),
		'deadline' => array
		(
		 	'label'                   => &$GLOBALS['TL_LANG']['tl_task']['deadline'],
		 	'exclude'                 => true,
		 	'sorting'                 => true,
		 	'inputType'               => 'text',
		 	'default'				  => 0,
			'eval'                    => array('rgxp'=>'date', 'datepicker'=>true, 'tl_class'=>'w50 wizard'),
			'sql'					  => "int(10) unsigned NOT NULL default '0'",
			'flag'                    => 6,
		),
		'assignedTo' => array(
      		'label' => &$GLOBALS['TL_LANG']['tl_task']['assignedTo'],
        ),
        'progress' => array(
      		'label' =>&$GLOBALS['TL_LANG']['tl_task']['progress'],
        ),
        'createdAt' => array
		(
		 	'label' 				  => array('Erstellt'),
			'default'                 => time(),
			'eval'                    => array('doNotCopy'=>true, 'rgxp'=>'date', 'datepicker'=>true, 'tl_class'=>'w50 wizard'),
			'sql'					  => "int(10) unsigned NOT NULL default '0'",
			'flag'                    => 6,
		),
		'createdBy' => array
		(
		 	'label'                   => &$GLOBALS['TL_LANG']['tl_task']['createdBy'],
			'default'                 => $this->User->id,
			'exclude'                 => true,
			'sorting'                 => true,
			'flag'                    => 11,
			'foreignKey'              => 'tl_user.name',
			'eval'                    => array('doNotCopy'=>true, 'chosen'=>true, 'mandatory'=>true, 'includeBlankOption'=>true, 'tl_class'=>'w50'),
			'sql'                     => "int(10) unsigned NOT NULL default '0'",
			'relation'                => array('type'=>'hasOne', 'load'=>'eager')
		),
		'description' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_task']['description'],
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'flag'                    => 1,
			'inputType'               => 'textarea',
			'eval'                    => array('rte'=>'tinyMCE', 'tl_class'=>'clr'),
			'sql'                     => "text NULL"
		),
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
	 * format labels
	 * @param array
	 * @param string
	 * @param \DataContainer
	 * @param array
	 * @return string
	 */
	public function editLabel($row, $label, DataContainer $dc, $args)  
    {	
    	$strAuthor = UserModel::findOneById($row['createdBy'])->name;
    	$args[0] = '<strong>'.$args[0].'</strong><br/><span class="tl_gray">'.'Erstellt von '.$strAuthor.'</span>';
    	$args[1] = TaskModel::getCurrentAssignedUserByTaskId($row['id']);
    	$args[2] = TaskModel::getCurrentProgressByTaskId($row['id']).'%';

        return $args;  
    }  
}