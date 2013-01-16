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
 
$this->loadLanguageFile('tl_task');

/**
 * Fields
 */
$GLOBALS['TL_LANG']['tl_user']['taskcenterEmailToYourself']       = array('Send email to yourself', 'Please select, if an email should be send, if you are the editor of a task, update it and <b>"Notify user"</b> is selected.');
$GLOBALS['TL_LANG']['tl_user']['taskcenterHistorySorting']        = array('Sorting of task history', 'Please select the sort order of the task history.');
$GLOBALS['TL_LANG']['tl_user']['taskcenterColumnsShortnameUsage'] = array('Column headings with shortnames', 'Please select, if for the column headings shortnames should be used.');
$GLOBALS['TL_LANG']['tl_user']['taskcenterColumnsVisibility']     = array('Visible table columns', 'Please select, which columns in the overview table from task center should be visible.');
$GLOBALS['TL_LANG']['tl_user']['taskcenterIconUsage']             = array('Icon usage', 'Please select, if for ' . $GLOBALS['TL_LANG']['tl_task']['tasktype'][0] . ', ' . $GLOBALS['TL_LANG']['tl_task']['priority'][0] . ' and ' . $GLOBALS['TL_LANG']['tl_task']['status'][0] . ' of a task an icon (including a detailed tooltip) should be used in teh overview table instead of the text.');
$GLOBALS['TL_LANG']['tl_user']['taskcenterIconPriorityIconSet']   = array('Iconset for priorities', 'Please select which icon set should be used for the priority icons.');

/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_user']['taskcenter_legend'] = 'Task Center';

/**
 * Select/Checkbox values
 */
$GLOBALS['TL_LANG']['tl_user']['taskcenterIconPriorityIconSet']['flags'] = array('Flags', 'To symbolize the different priority levels the following flags will be are used:<ul>'
																		. '<li><img src="system/modules/TaskCenterExtended/html/priority_flag_5_very_high" alt="' . $GLOBALS['TL_LANG']['tl_task_priority']['5_very_high'] . '" title="' . $GLOBALS['TL_LANG']['tl_task_priority']['5_very_high'] . '" /> ' . $GLOBALS['TL_LANG']['tl_task_priority']['5_very_high'] . '</li>'
																		. '<li><img src="system/modules/TaskCenterExtended/html/priority_flag_4_high" alt="' . $GLOBALS['TL_LANG']['tl_task_priority']['4_high'] . '" title="' . $GLOBALS['TL_LANG']['tl_task_priority']['4_high'] . '" /> ' . $GLOBALS['TL_LANG']['tl_task_priority']['4_high'] . '</li>'
																		. '<li><img src="system/modules/TaskCenterExtended/html/priority_flag_3_normal" alt="' . $GLOBALS['TL_LANG']['tl_task_priority']['3_normal'] . '" title="' . $GLOBALS['TL_LANG']['tl_task_priority']['3_normal'] . '" /> ' . $GLOBALS['TL_LANG']['tl_task_priority']['3_normal'] . '</li>'
																		. '<li><img src="system/modules/TaskCenterExtended/html/priority_flag_2_low" alt="' . $GLOBALS['TL_LANG']['tl_task_priority']['2_low'] . '" title="' . $GLOBALS['TL_LANG']['tl_task_priority']['2_low'] . '" /> ' . $GLOBALS['TL_LANG']['tl_task_priority']['2_low'] . '</li>'
																		. '<li><img src="system/modules/TaskCenterExtended/html/priority_flag_1_very_low" alt="' . $GLOBALS['TL_LANG']['tl_task_priority']['1_very_low'] . '" title="' . $GLOBALS['TL_LANG']['tl_task_priority']['1_very_low'] . '" /> ' . $GLOBALS['TL_LANG']['tl_task_priority']['1_very_low'] . '</li>'
																		. '</ul>');
$GLOBALS['TL_LANG']['tl_user']['taskcenterIconPriorityIconSet']['arrows'] = array('Arrows', 'To symbolize the different priority levels the following arrows will be are used:<ul>'
																		. '<li><img src="system/modules/TaskCenterExtended/html/priority_arrow_5_very_high" alt="' . $GLOBALS['TL_LANG']['tl_task_priority']['5_very_high'] . '" title="' . $GLOBALS['TL_LANG']['tl_task_priority']['5_very_high'] . '" /> ' . $GLOBALS['TL_LANG']['tl_task_priority']['5_very_high'] . '</li>'
																		. '<li><img src="system/modules/TaskCenterExtended/html/priority_arrow_4_high" alt="' . $GLOBALS['TL_LANG']['tl_task_priority']['4_high'] . '" title="' . $GLOBALS['TL_LANG']['tl_task_priority']['4_high'] . '" /> ' . $GLOBALS['TL_LANG']['tl_task_priority']['4_high'] . '</li>'
																		. '<li><img src="system/modules/TaskCenterExtended/html/priority_arrow_3_normal" alt="' . $GLOBALS['TL_LANG']['tl_task_priority']['3_normal'] . '" title="' . $GLOBALS['TL_LANG']['tl_task_priority']['3_normal'] . '" /> ' . $GLOBALS['TL_LANG']['tl_task_priority']['3_normal'] . '</li>'
																		. '<li><img src="system/modules/TaskCenterExtended/html/priority_arrow_2_low" alt="' . $GLOBALS['TL_LANG']['tl_task_priority']['2_low'] . '" title="' . $GLOBALS['TL_LANG']['tl_task_priority']['2_low'] . '" /> ' . $GLOBALS['TL_LANG']['tl_task_priority']['2_low'] . '</li>'
																		. '<li><img src="system/modules/TaskCenterExtended/html/priority_arrow_1_very_low" alt="' . $GLOBALS['TL_LANG']['tl_task_priority']['1_very_low'] . '" title="' . $GLOBALS['TL_LANG']['tl_task_priority']['1_very_low'] . '" /> ' . $GLOBALS['TL_LANG']['tl_task_priority']['1_very_low'] . '</li>'
																		. '</ul>');
?>