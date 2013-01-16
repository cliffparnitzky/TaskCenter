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
 * Fields
 */

$GLOBALS['TL_LANG']['tl_task']['t.id']                = 'ID';
$GLOBALS['TL_LANG']['tl_task']['project']             = array('Project', 'Please select the project of this task.');
$GLOBALS['TL_LANG']['tl_task']['project']['short']    = 'Project';
$GLOBALS['TL_LANG']['tl_task']['projectName']         = $GLOBALS['TL_LANG']['tl_task']['project'][0];
$GLOBALS['TL_LANG']['tl_task']['tasktype']            = array('Tasktype', 'Please select the type of the task.');
$GLOBALS['TL_LANG']['tl_task']['tasktype']['short']   = 'Type';
$GLOBALS['TL_LANG']['tl_task']['title']['short']      = 'Title';
$GLOBALS['TL_LANG']['tl_task']['assignedTo']          = array('Editor');;
$GLOBALS['TL_LANG']['tl_task']['assignedTo']['short'] = 'Editor';
$GLOBALS['TL_LANG']['tl_task']['priority']            = array('Priority', 'Please select the priority of the task.');
$GLOBALS['TL_LANG']['tl_task']['priority']['short']   = 'Prio';
$GLOBALS['TL_LANG']['tl_task']['status']['short']     = 'Status';
$GLOBALS['TL_LANG']['tl_task']['progress']['short']   = 'Progress';
$GLOBALS['TL_LANG']['tl_task']['deadline']            = array('Deadline', 'Please select the deadline of this task.');
$GLOBALS['TL_LANG']['tl_task']['deadline']['short']   = 'Finish';


/**
 * Labels for last update for detail page
 */
$GLOBALS['TL_LANG']['tl_task']['lastUpdate']     = 'Last update';
$GLOBALS['TL_LANG']['tl_task']['lastUpdateUser'] = 'Updated by';
$GLOBALS['TL_LANG']['tl_task']['lastUpdateTime'] = 'Updated at';

/**
 * Priority
 */
$GLOBALS['TL_LANG']['tl_task_priority']['5_very_high'] = 'very high';
$GLOBALS['TL_LANG']['tl_task_priority']['4_high']      = 'high';
$GLOBALS['TL_LANG']['tl_task_priority']['3_normal']    = 'normal';
$GLOBALS['TL_LANG']['tl_task_priority']['2_low']       = 'low';
$GLOBALS['TL_LANG']['tl_task_priority']['1_very_low']  = 'very low';

/**
 * Type
 */
$GLOBALS['TL_LANG']['tl_task_tasktype']['exercise']    = 'Exercise';
$GLOBALS['TL_LANG']['tl_task_tasktype']['bug']         = 'Bug';
$GLOBALS['TL_LANG']['tl_task_tasktype']['new_feature'] = 'New Feature';
$GLOBALS['TL_LANG']['tl_task_tasktype']['improvement'] = 'Improvement';

/**
 * Status
 */
$GLOBALS['TL_LANG']['tl_task_status']['analysed']  = 'Analysed';
$GLOBALS['TL_LANG']['tl_task_status']['suspended'] = 'Suspended';
$GLOBALS['TL_LANG']['tl_task_status']['archived']  = 'Archived';

/**
 * Submit buttons
 */
$GLOBALS['TL_LANG']['tl_task']['createSubmit']        = 'Create';
$GLOBALS['TL_LANG']['tl_task']['createSubmitAndEdit'] = 'Create and edit';
$GLOBALS['TL_LANG']['tl_task']['createSubmitAndNew']  = 'Create and new';
$GLOBALS['TL_LANG']['tl_task']['editSubmit']          = 'Update';
$GLOBALS['TL_LANG']['tl_task']['editSubmitAndClose']  = 'Update and close';

/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_task']['show'] = array('Show task', 'Show task ID %s');

/**
 * Filter label
 */
$GLOBALS['TL_LANG']['tl_task']['special_filter'] = "Special filter";

/**
 * Select options for history sort order
 */
$GLOBALS['TL_LANG']['tl_task']['historySortOrder']['ASC']  = '&#8595; Last update below';
$GLOBALS['TL_LANG']['tl_task']['historySortOrder']['DESC'] = '&#8593; Last update above';

?>