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
 * Table tl_user
 */
 
/**
 * Adding the task center settings to the login pallet of the user
 */
$GLOBALS['TL_DCA']['tl_user']['palettes']['login'] .= ';{taskcenter_legend},taskcenterEmailToYourself,taskcenterHistorySorting,taskcenterColumnsVisibility,taskcenterColumnsShortnameUsage,taskcenterIconUsage,taskcenterIconPriorityIconSet';

/**
 * Adding the fields
 */
$GLOBALS['TL_DCA']['tl_user']['fields']['taskcenterEmailToYourself'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_user']['taskcenterEmailToYourself'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'eval'                    => array('tl_class'=>'w50')
);
$GLOBALS['TL_DCA']['tl_user']['fields']['taskcenterHistorySorting'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_user']['taskcenterHistorySorting'],
	'exclude'                 => true,
	'inputType'               => 'select',
	'options'                 => array('ASC', 'DESC'),
	'eval'                    => array('tl_class'=>'w50'),
	'reference'               => &$GLOBALS['TL_LANG']['tl_task']['historySortOrder']
);
$GLOBALS['TL_DCA']['tl_user']['fields']['taskcenterColumnsVisibility'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_user']['taskcenterColumnsVisibility'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'options'                 => array('project', 'tasktype', 'title', 'assignedTo', 'priority', 'status', 'progress', 'deadline'),
	'eval'                    => array('tl_class'=>'clr w50', 'multiple'=>true),
	'reference'               => &$GLOBALS['TL_LANG']['tl_task']
);
$GLOBALS['TL_DCA']['tl_user']['fields']['taskcenterColumnsShortnameUsage'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_user']['taskcenterColumnsShortnameUsage'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'eval'                    => array('tl_class'=>'w50')
);
$GLOBALS['TL_DCA']['tl_user']['fields']['taskcenterIconUsage'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_user']['taskcenterIconUsage'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'eval'					  => array('tl_class'=>'w50 clr')
);
$GLOBALS['TL_DCA']['tl_user']['fields']['taskcenterIconPriorityIconSet'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_user']['taskcenterIconPriorityIconSet'],
	'exclude'                 => true,
	'inputType'               => 'select',
	'options'                 => array ('flags', 'arrows'),
	'eval'                    => array('tl_class'=>'w50', 'helpwizard'=>true),
	'reference'               => &$GLOBALS['TL_LANG']['tl_user']['taskcenterIconPriorityIconSet']
);

?>