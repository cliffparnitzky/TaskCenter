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
 * Back end modules
 */
unset($GLOBALS['BE_MOD']['profile']['tasks']);
$GLOBALS['BE_MOD']['taskcenter']['tasks'] = array
(
	'callback' => 'ModuleTasksExtended',
	'icon'     => 'system/modules/TaskCenterExtended/html/icon_tasks.png'
);
$GLOBALS['BE_MOD']['taskcenter']['projects'] = array
(
	'tables' => array('tl_task_project'),
	'icon'     => 'system/modules/TaskCenterExtended/html/icon_projects.png'
);
// $GLOBALS['BE_MOD']['taskcenter']['workflows'] = array
// (
// 	'tables' => array('tl_task_workflow','tl_task_workflow_transitions'),
// 	'icon'     => 'system/modules/TaskCenterExtended/html/icon_workflow.png'
// );

/**
 * Front end modules
 */
// $GLOBALS['FE_MOD']['taskcenter']= array
// (
// 	'task_creation' => 'ModuleTasksCreate',
// 	'task_listing'  => 'ModuleTasksList'
// ) ;

/**
 * Daily cron job to send notification mails to assignee, if the deadline of its task will be reached in a special time period (defined from admin in backend)
 */
// $GLOBALS['TL_CRON']['daily'][] = array('TaskCenterMailSender', 'sendDeadlineNotificationMail');

?>