<?php

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
		'ptable'                      => 'tl_tasks',
		'switchToEdit'                => true,
		'enableVersioning'            => true,
		'sql' => array
		(
			'keys' => array
			(
				'id' => 'primary',
				'pid' => 'index',
			)
		)
	),

	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 4,
			'fields'                  => array('tstamp'),
			'flag'                    => 8,
			'headerFields'            => array('title', 'createdBy', 'description'),
			'child_record_callback'	  => array('tl_task_status', 'listTaskStatusUpdates'),
			'child_record_class'      => 'no_padding',
			'header_callback'		  => array('tl_task_status', 'showTask'),
		),
		'label' => array
		(
			'fields'                  => array('comment', 'createdBy'),
			'format'                  => '%s %s'
		),
		'operations' => array
		(
			'edit' => array
			(
				'href'                => 'act=edit',
				'icon'                => 'edit.gif',
				'attributes'          => 'class="edit-header"'
			),
			'delete' => array
			(
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"',
			),
		),
	),

	// Palettes
	'palettes' => array
	(
		'default'                     => '{status_legend},status,assignedTo,progress;{comment_legend},comment;',
	),

	// Fields
	'fields' => array
	(
		'id' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL auto_increment"
		),
		'pid' => array
		(
			'foreignKey'              => 'tl_tasks.title',
			'sql'                     => "int(10) unsigned NOT NULL default '0'",
			'relation'                => array('type'=>'belongsTo', 'load'=>'eager')
		),
		'tstamp' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'createdBy' => array
		(
		 	'label'                   => &$GLOBALS['TL_LANG']['tl_news']['author'],
			'default'                 => $this->User->id,
			'eval'                    => array('doNotCopy'=>true),
			'sql'                     => "int(10) unsigned NOT NULL default '0'",
			'relation'                => array('type'=>'hasOne', 'load'=>'eager')
		),
		'assignedTo' => array
		(
		 	'inputType'               => 'select',
		 	'foreignKey'              => 'tl_user.name',
			'eval'                    => array('doNotCopy'=>true, 'chosen'=>true, 'includeBlankOption'=>true, 'tl_class'=>'w50'),
			'relation'                => array('type'=>'hasOne', 'load'=>'eager'),
            'sql' 					  => "int(10) unsigned NOT NULL default '0'",
        ),
		'status' => array
		(
		 	'inputType'               => 'text',
		 	'eval'                    => array('doNotCopy'=>true, 'tl_class'=>'w50'),
			'sql' 					  => "varchar(32) NOT NULL default ''",
		),
		'progress' => array
		(
		 	'inputType'               => 'text',
		 	'eval'                    => array('doNotCopy'=>true, 'tl_class'=>'long'),
			'sql' 					  => "smallint(5) unsigned NOT NULL default '0'",
		),
		'comment' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_tasks']['headline'],
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'flag'                    => 1,
			'inputType'               => 'textarea',
			'eval'                    => array('rte'=>'tinyMCE', 'tl_class'=>'clr'),
			'sql'                     => "text NULL"
		),
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
	 * List all task updates
	 * @param array
	 * @return string
	 */
	public function listTaskStatusUpdates($arrRow)
	{
		$user = UserModel::findOneById($arrRow['createdBy']);

		return '<div class="tl_content_left">' . $arrRow['headline'] . ' <span class="tl_gray">' . $this->parseDate($GLOBALS['TL_CONFIG']['datimFormat'], $arrRow['tstamp']) . '<br/>- '.$user->name.'</span></div>';
	}

	/**
	 * Show the task data in the header of the status listing
	 * @param  Array        $arrHeaderFields the headerfields given from list->sorting
	 * @param  Datacontainer $dc              a Datacontainer Object
	 * @return Array                         The manipulated headerfields
	 */
	public function showTask($arrHeaderFields, Datacontainer $dc)
	{
		// return '<div class="tl_header_table">Foobar</div>';
		// TODO: DC_Table change :-)
		return $arrHeaderFields;
	}

}