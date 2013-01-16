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
 * Table tl_task_workflow
 */
$GLOBALS['TL_DCA']['tl_task_workflow'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'ctable'                      => array('tl_task_workflow_transitions'),
		'enableVersioning'            => true
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 1,
			'fields'                  => array('name'),
			'flag'                    => 1,
			'panelLayout'             => 'filter;sort,search,limit'
		), 
		'label' => array
		(
			'fields'                  => array('name'),
			'label_callback'          => array('tl_task_workflow', 'extendLabel'),
		),
		'global_operations' => array
		(
			'importWorkflow' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_task_workflow']['importWorkflow'],
				'href'                => 'key=importWorkflow',
				'class'               => 'header_workflow_import',
				'attributes'          => 'onclick="Backend.getScrollOffset();"',
				'icon'                => 'icon_workflow_import.png'
			),
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
				'label'               => &$GLOBALS['TL_LANG']['tl_task_workflow']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_task_workflow']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_task_workflow']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif',
				'attributes'          => 'style="margin-right:3px"'
			),
			'toggle' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_task_workflow']['toggle'],
				'icon'                => 'visible.gif',
				'attributes'          => 'onclick="Backend.getScrollOffset(); return AjaxRequest.toggleVisibility(this, %s);"',
				'button_callback'     => array('tl_task_workflow', 'toggleIcon')
			),  
			'transitions' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_task_workflow']['transitions'],
				'href'                => 'table=tl_task_workflow_transitions',
				'icon'                => $TL_ROOT . 'system/modules/TaskCenterExtended/html/icon_transitions.png',
				'button_callback'     => array('tl_task_workflow', 'editTransitions')
			),
			'exportWorkflow' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_task_workflow']['exportWorkflow'],
				'href'                => 'key=exportWorkflow',
				'icon'                => $TL_ROOT . 'system/modules/TaskCenterExtended/html/icon_workflow_export.png'
			)
		)
	),

	// Palettes
	'palettes' => array
	(
		'default'                     => '{workflow_legend},name,shortname,author,description,previewImage;{publish_legend},published,start,stop'
	),

	// Fields
	'fields' => array
	(
		'name' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_task_workflow']['name'],
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'flag'                    => 1,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50')
		),
		'shortname' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_task_workflow']['shortname'],
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'filter'                  => true,
			'flag'                    => 1,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'rgxp' => 'extnd', 'maxlength'=>32, 'tl_class'=>'w50', 'unique'=>true)
		),
		'creators' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_task_workflow']['creators'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'sorting'                 => true,
			'flag'                    => 11,
			'search'                  => true,
			'eval'                    => array('mandatory'=>true, 'maxlength'=>128, 'tl_class'=>'w50')
		),
		'description' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_task_workflow']['description'],
			'exclude'                 => true,
			'inputType'               => 'textarea',
			'eval'                    => array('rte'=>'tinyTask', 'tl_class'=>'clr')
		),
		'previewImage' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_task_workflow']['previewImage'],
			'exclude'                 => true,
			'inputType'               => 'fileTree',
			'eval'                    => array('fieldType'=>'radio', 'files'=>true, 'filesOnly'=>true, 'extensions'=>'jpg,png,gif', 'tl_class'=>'w50')
		),
		'published' => array
		(
			'exclude'                 => true,
			'filter'                  => true,
			'label'                   => &$GLOBALS['TL_LANG']['tl_task_workflow']['published'],
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
		) 
	)
);

/**
 * Class tl_task_workflow
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * @copyright  Cliff Parnitzky 2011
 * @author     Cliff Parnitzky
 * @package    Controller
 */
class tl_task_workflow extends Backend
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
	 * Return the edit Transitions button
	 * @param array
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @return string
	 */
	public function editTransitions($row, $href, $label, $title, $icon, $attributes)
	{
		return ($this->User->isAdmin || $this->User->hasAccess('transitions', 'workflows')) ? '<a href="'.$this->addToUrl($href.'&amp;id='.$row['id']).'" title="'.specialchars($title).'"'.$attributes.'>'.$this->generateImage($icon, $label).'</a> ' : $this->generateImage(preg_replace('/\.png$/i', '_.png', $icon)).' ';
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
		if (!$this->User->isAdmin && !$this->User->hasAccess('tl_task_workflow::published', 'alexf'))
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
	 * Publish/unpublish a workflow
	 * @param integer
	 * @param boolean
	 */
	public function toggleVisibility($intId, $blnVisible)
	{
		// Check permissions
		if (!$this->User->isAdmin && !$this->User->hasAccess('tl_task_workflow::published', 'alexf'))
		{
			$this->log('Not enough permissions to publish/unpublish workflow ID "'.$intId.'"', 'tl_task_workflow toggleVisibility', TL_ERROR);
			$this->redirect('contao/main.php?act=error');
		}

		$this->createInitialVersion('tl_task_workflow', $intId);
	
		// Trigger the save_callback
		if (is_array($GLOBALS['TL_DCA']['tl_task_workflow']['fields']['published']['save_callback']))
		{
			foreach ($GLOBALS['TL_DCA']['tl_task_workflow']['fields']['published']['save_callback'] as $callback)
			{
				$this->import($callback[0]);
				$blnVisible = $this->$callback[0]->$callback[1]($blnVisible, $this);
			}
		}

		$time = time();

		// Update the database
		$this->Database->prepare("UPDATE tl_task_workflow SET tstamp=$time, published='" . (!$blnVisible ? '' : 1) . "' WHERE id=?")
					   ->execute($intId);

		$this->createNewVersion('tl_task_workflow', $intId);
	} 

	/**
	 * Extends the label
	 * @param array
	 * @param string
	 * @return string
	 */
	public function extendLabel($row, $label)
	{
		$icon = 'icon_workflow';

		if (!$row['published'] || strlen($row['start']) && $row['start'] > time() || strlen($row['stop']) && $row['stop'] < time())
		{
			$icon .= '_';
		}
		
		$newLabel = '<div class="list_icon" style="height: 1.5em; background:url(\'system/modules/TaskCenterExtended/html/' . $icon . '.png\') left top no-repeat transparent;"><div>' .$row['name'] . '</div>';
		if ($row['previewImage'] != '' && file_exists(TL_ROOT . '/' . $row['previewImage']))
		{
			$newLabel .= '<img src="'.$this->getImage($row['previewImage'], 160, 120).'" width="160" height="120" alt="" style="float: left; margin:3px 6px 3px 0; vertical-align:middle;" />';
		}
		if ($row['description'] != '')
		{
			$newLabel .= '<div style="float: left; height: 130px; overflow: hidden;">' . $row['description'] . '</div>';
		}
		$newLabel .= '</div>';

		return $newLabel;
	} 
}

?>