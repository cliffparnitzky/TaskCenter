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
 * Table tl_task_project
 */
$GLOBALS['TL_DCA']['tl_task_project'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'enableVersioning'            => true
	),

	// List
	'list' => array
	(
		'sorting' => array (
			'mode'                    => 2,
			'fields'                  => array('shortname'),
			'flag'                    => 1,
			'panelLayout'             => 'filter;sort,search,limit' 
		),
		'label' => array
		(
			'fields'                  => array('shortname','name','manager:tl_user.name'),
			'format'                  => '[%s] - %s <span style="color: #A3A3A3; padding-left: 3px; font-style: italic;">(' . $GLOBALS['TL_LANG']['tl_task_project']['manager'][0] . ': %s)</span>',
			'label_callback'          => array('tl_task_project', 'addIcon') 
		),
		'global_operations' => array
		(
			'all' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'                => 'act=select',
				'class'               => 'header_edit_all',
				'attributes'          => 'onclick="Backend.getScrollOffset();"'
			)
		),
		'operations' => array
		(
			'edit' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_task_project']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif'
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_task_project']['copy'],
				'href'                => 'act=copy',
				'icon'                => 'copy.gif'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_task_project']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
			),
			'toggle' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_task_project']['toggle'],
				'icon'                => 'visible.gif',
				'attributes'          => 'onclick="Backend.getScrollOffset(); return AjaxRequest.toggleVisibility(this, %s);"',
				'button_callback'     => array('tl_task_project', 'toggleIcon')
			), 
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_task_project']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),

	// Palettes
	'palettes' => array
	(
		'__selector__'                => array('allowGroups'), 
		'default'                     => '{project_legend},name,shortname,description,url,number;{management_legend},manager,manager_deputy,notifyManagement;{groups_legend},allowGroups;{publish_legend},published,start,stop'
	),

	// Subpalettes
	'subpalettes' => array
	(
		'allowGroups'                     => 'userGroups,memberGroups'
	), 

	// Fields
	'fields' => array
	(
		'name' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_task_project']['name'],
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'flag'                    => 1,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50')
		),
		'shortname' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_task_project']['shortname'],
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'filter'                  => true,
			'flag'                    => 1,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'rgxp' => 'extnd', 'maxlength'=>20, 'tl_class'=>'w50', 'unique'=>true)
		),
		'description' => array
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
			'label'                   => &$GLOBALS['TL_LANG']['tl_task_project']['start'],
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'date', 'datepicker'=>$this->getDatePickerString(), 'tl_class'=>'w50 wizard')
		),
		'stop' => array
		(
			'exclude'                 => true,
			'label'                   => &$GLOBALS['TL_LANG']['tl_task_project']['stop'],
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'date', 'datepicker'=>$this->getDatePickerString(), 'tl_class'=>'w50 wizard')
		) 
	)
);

/**
 * Class tl_task_project
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * @copyright  Cliff Parnitzky 2011
 * @author     Cliff Parnitzky
 * @package    Controller
 */
class tl_task_project extends Backend
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
	 * Add an image to each record
	 * @param array
	 * @param string
	 * @return string
	 */
	public function addIcon($row, $label)
	{
		$image = 'icon_projects';

		if (!$row['published'] || strlen($row['start']) && $row['start'] > time() || strlen($row['stop']) && $row['stop'] < time())
		{
			$image .= '_';
		}

		return sprintf('<div class="list_icon" style="background-image:url(\'system/modules/TaskCenterExtended/html/%s.png\');">%s</div>', $image, $label);
	} 
	
	/**
	 * Return the "toggle visibility" button
	 * @param array
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @return string
	 */
	public function toggleIcon($row, $href, $label, $title, $icon, $attributes)
	{
		if (strlen($this->Input->get('tid')))
		{
			$this->toggleVisibility($this->Input->get('tid'), ($this->Input->get('state') == 1));
			$this->redirect($this->getReferer());
		}

		// Check permissions AFTER checking the tid, so hacking attempts are logged
		if (!$this->User->isAdmin && !$this->User->hasAccess('tl_task_project::published', 'alexf'))
		{
			return '';
		}

		$href .= '&amp;tid='.$row['id'].'&amp;state='.!$row['published'];

		if (!$row['published'])
		{
			$icon = 'invisible.gif';
		}		

		return '<a href="'.$this->addToUrl($href).'" title="'.specialchars($title).'"'.$attributes.'>'.$this->generateImage($icon, $label).'</a> ';
	}

	/**
	 * Publish/unpublish a project
	 * @param integer
	 * @param boolean
	 */
	public function toggleVisibility($intId, $blnVisible)
	{
		// Check permissions
		if (!$this->User->isAdmin && !$this->User->hasAccess('tl_task_project::published', 'alexf'))
		{
			$this->log('Not enough permissions to publish/unpublish project ID "'.$intId.'"', 'tl_task_project toggleVisibility', TL_ERROR);
			$this->redirect('contao/main.php?act=error');
		}

		$this->createInitialVersion('tl_task_project', $intId);
	
		// Trigger the save_callback
		if (is_array($GLOBALS['TL_DCA']['tl_task_project']['fields']['published']['save_callback']))
		{
			foreach ($GLOBALS['TL_DCA']['tl_task_project']['fields']['published']['save_callback'] as $callback)
			{
				$this->import($callback[0]);
				$blnVisible = $this->$callback[0]->$callback[1]($blnVisible, $this);
			}
		}

		$time = time();

		// Update the database
		$this->Database->prepare("UPDATE tl_task_project SET tstamp=$time, published='" . (!$blnVisible ? '' : 1) . "' WHERE id=?")
					   ->execute($intId);

		$this->createNewVersion('tl_task_project', $intId);
	} 
}

?>