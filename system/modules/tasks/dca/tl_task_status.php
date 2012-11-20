<?php

/**
 * Load tl_task_status language file
 */
$this->loadLanguageFile('tl_task');
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
		),
	),

	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 4,
			'fields'                  => array('createdAt'),
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
		 	'label'                   => &$GLOBALS['TL_LANG']['tl_task']['createdBy'],
			'default'                 => $this->User->id,
			'eval'                    => array('doNotCopy'=>true),
			'sql'                     => "int(10) unsigned NOT NULL default '0'",
			'relation'                => array('type'=>'hasOne', 'load'=>'eager')
		),
		'createdAt' => array
		(
			'default'                 => time(),
			'eval'                    => array('doNotCopy'=>true),
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'assignedTo' => array
		(
		 	'inputType'               => 'select',
		 	'foreignKey'              => 'tl_user.name',
			'eval'                    => array('doNotCopy'=>true, 'chosen'=>true, 'includeBlankOption'=>true, 'tl_class'=>'w50'),
			'relation'                => array('type'=>'hasOne', 'load'=>'eager'),
            'sql' 					  => "int(10) unsigned NULL",
        ),
		'status' => array
		(
		 	'inputType'               => 'text',
		 	'eval'                    => array('doNotCopy'=>true, 'tl_class'=>'w50'),
			'sql' 					  => "varchar(32) NULL",
		),
		'progress' => array
		(
		 	'inputType'               => 'text',
		 	'eval'                    => array('doNotCopy'=>true, 'tl_class'=>'long'),
			'sql' 					  => "smallint(5) unsigned NULL",
		),
		'comment' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_task']['comment'],
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'flag'                    => 1,
			'inputType'               => 'textarea',
			'eval'                    => array('tl_class'=>'clr'),
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
		$return = ' <span class="tl_gray">' . $this->parseDate($GLOBALS['TL_CONFIG']['datimFormat'], $arrRow['tstamp']).' - '.static::getUsernameById($arrRow['createdBy']).'</span>';
		$return .= '<div class="comment">'.$arrRow['comment'].'</div>';

		unset($arrRow['comment']);
		unset($arrRow['id']);
		unset($arrRow['pid']);
		unset($arrRow['tstamp']);
		unset($arrRow['createdAt']);
		unset($arrRow['createdBy']);

		$return .= '<ul class="updated">';
		foreach($arrRow as $k=>$v)
		{
			if($v === null)
			{
				// not false so something has changed
				continue;
			}

			if($k === 'assignedTo')
			{
				$v = static::getUsernameById($v);
			}

			$return .= '<li>'.$k.': '.$v.'</li>';
		}
		$return .= '</ul>';

		return $return;
	}

	/**
	 * Show the task data in the header of the status listing
	 * @param  Array        $arrHeaderFields the headerfields given from list->sorting
	 * @param  Datacontainer $dc              a Datacontainer Object
	 * @return Array                         The manipulated headerfields
	 */
	public function showTask($arrHeaderFields, Datacontainer $dc)
	{
		$arrHeaderFields['title'] = '<strong>'.$arrHeaderFields['title'].'</strong>';

		$intCurrentId = (int) $dc->id;

		// Add assigned user
		$objResult = $this->Database->prepare("SELECT `assignedTo`, `tstamp` FROM `tl_task_status` WHERE pid=? AND `assignedTo` IS NOT NULL ORDER BY `createdAt` DESC")
									 ->limit(1)
									 ->execute($intCurrentId);

		$arrHeaderFields['assignedTo'] = $GLOBALS['TL_LANG']['tl_task']['notAssigned'];

		while ($objResult->next())
		{
			if($intUserId = $objResult->assignedTo)
			{
				$arrHeaderFields['assignedTo'] = static::getUsernameById($intUserId);
			}			
		}

		// Add progress
		$objResult = $this->Database->prepare("SELECT `progress` FROM `tl_task_status` WHERE pid=? AND `progress` IS NOT NULL ORDER BY `createdAt` DESC")
									 ->limit(1)
									 ->execute($intCurrentId);

		$arrHeaderFields['progress'] = '0 %';

		while ($objResult->next())
		{
			$arrHeaderFields['progress'] = $objResult->progress.' %';			
		}

		return $arrHeaderFields;
	}

	public static function getUsernameById($id)
	{
		$user = UserModel::findOneById($id);
		return $user->name;
	}

}