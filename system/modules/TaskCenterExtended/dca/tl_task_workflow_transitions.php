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
 * @copyright  Cliff Parnitzky 2011
 * @author     Cliff Parnitzky
 * @package    TaskCenterExtended
 * @license    LGPL
 */
 
/**
 * Table tl_task_workflow_transitions
 */
$GLOBALS['TL_DCA']['tl_task_workflow_transitions'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'ptable'                      => 'tl_task_workflow',
		'enableVersioning'            => true,
		'onload_callback' => array
		(
			array('tl_task_workflow_transitions', 'checkPermission')
		)
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 4,
			'fields'                  => array('tasktype'),
			'panelLayout'             => 'filter;sort,search,limit',
			'headerFields'            => array('name', 'author', 'tstamp'),
			'child_record_callback'   => array('tl_task_workflow_transitions', 'listTransitions'),
			'child_record_class'      => 'no_padding'
		), 
		'global_operations' => array
		(
			'all' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'                => 'act=select',
				'class'               => 'header_edit_all',
				'attributes'          => 'onclick="Backend.getScrollOffset();" accesskey="e"'
			)
		),
		'operations' => array
		(
			'edit' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_task_workflow_transitions']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif'
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_task_workflow_transitions']['copy'],
				'href'                => 'act=paste&amp;mode=copy',
				'icon'                => 'copy.gif',
				'attributes'          => 'onclick="Backend.getScrollOffset();"'
			),
			'cut' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_task_workflow_transitions']['cut'],
				'href'                => 'act=paste&amp;mode=cut',
				'icon'                => 'cut.gif',
				'attributes'          => 'onclick="Backend.getScrollOffset();"'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_task_workflow_transitions']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_task_workflow_transitions']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),

	// Palettes
	'palettes' => array
	(
		'default'                     => '{tasktype_legend},tasktype;'
	),

	// Fields
	'fields' => array
	(
		'tasktype' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_task_workflow_transitions']['tasktype'],
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'flag'                    => 1,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50')
		),
		/*'description' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_task_project']['description'],
			'exclude'                 => true,
			'inputType'               => 'textarea',
			'eval'                    => array('rte'=>'tinyTask', 'tl_class'=>'clr')
		),
		'url' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_task_project']['url'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp' => 'url', 'maxlength'=>255, 'tl_class'=>'w50')
		),
		'number' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_task_project']['number'],
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'flag'                    => 1,
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'alnum', 'maxlength'=>20, 'tl_class'=>'w50', 'unique'=>true, 'spaceToUnderscore'=>true)
		),
		'manager' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_task_project']['manager'],
			'exclude'                 => true,
			'sorting'                 => true,
			'filter'                  => true,
			'flag'                    => 1,
			'inputType'               => 'select',
			'foreignKey'			  => 'tl_user.name',
			'eval'                    => array('mandatory'=>true, 'includeBlankOption'=>true, 'tl_class'=>'w50')
		),
		'manager_deputy' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_task_project']['manager_deputy'],
			'exclude'                 => true,
			'inputType'               => 'select',
			'foreignKey'			  => 'tl_user.name',
			'eval'                    => array('includeBlankOption'=>true, 'tl_class'=>'w50')
		),
		'notifyManagement' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_task_project']['notifyManagement'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('tl_class'=>'m12 w50')
		),
		'allowGroups' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_task_project']['allowGroups'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('submitOnChange'=>true)
		),
		'userGroups' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_task_project']['userGroups'],
			'exclude'                 => true,
			'filter'                  => true,
			'inputType'               => 'checkbox',
			'foreignKey'			  => 'tl_user_group.name',
			'eval'                    => array('mandatory'=>true, 'multiple'=>true, 'tl_class'=>'w50')
		),
		'memberGroups' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_task_project']['memberGroups'],
			'exclude'                 => true,
			'filter'                  => true,
			'inputType'               => 'checkbox',
			'foreignKey'			  => 'tl_member_group.name',
			'eval'                    => array('multiple'=>true, 'tl_class'=>'w50')
		),
		'published' => array
		(
			'exclude'                 => true,
			'filter'                  => true,
			'label'                   => &$GLOBALS['TL_LANG']['tl_task_project']['published'],
			'inputType'               => 'checkbox',
			'eval'                    => array('doNotCopy'=>true)
		),
		'start' => array
		(
			'exclude'                 => true,
			'label'                   => &$GLOBALS['TL_LANG']['tl_task_workflow']['start'],
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'date', 'datepicker'=>$this->getDatePickerString(), 'tl_class'=>'w50 wizard')
		),
		'stop' => array
		(
			'exclude'                 => true,
			'label'                   => &$GLOBALS['TL_LANG']['tl_task_workflow']['stop'],
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'date', 'datepicker'=>$this->getDatePickerString(), 'tl_class'=>'w50 wizard')
		)*/
	)
);

/**
 * Class tl_module
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * @copyright  Leo Feyer 2005-2011
 * @author     Leo Feyer <http://www.contao.org>
 * @package    Controller
 */
class tl_task_workflow_transitions extends Backend
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
	 * Check permissions to edit the table
	 */
	public function checkPermission()
	{
		if ($this->User->isAdmin)
		{
			return;
		}

		if (!$this->User->hasAccess('transitions', 'workflows'))
		{
			$this->log('Not enough permissions to access the transitions module', 'tl_task_workflow_transitions checkPermission', TL_ERROR);
			$this->redirect('contao/main.php?act=error');
		}
	}

	/**
	 * List a front end module
	 * @param array
	 * @return string
	 */
	public function listTransitions($row)
	{
		return '<div style="float:left;">'. $row['tasktype'] .' <span style="color:#b3b3b3; padding-left:3px;">['. (isset($GLOBALS['TL_LANG']['FMD'][$row['type']][0]) ? $GLOBALS['TL_LANG']['FMD'][$row['type']][0] : $row['type']) .']</span>' . "</div>\n";
	}

}

?>