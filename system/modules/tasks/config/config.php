<?php

/**
 * Contao Open Source CMS
 *
 * @copyright  Leo Feyer 2005-2012
 * @copyright  Cliff Parnitzky 2013
 * @package    Tasks
 * @license    LGPL
 */

/**
 * Back end modules
 */
$GLOBALS['BE_MOD']['taskcenter']['task'] = array
(
	'tables'     => array('tl_task', 'tl_task_status'),
	'icon'       => 'system/modules/tasks/html/icon_task.png',
	'stylesheet' => 'system/modules/tasks/html/style.css' 
);

/**
 * System messages
 */
// $GLOBALS['TL_HOOKS']['getSystemMessages'][] = array('TaskMessages', 'listTasks');

/**
 * Register hooks
 */
$GLOBALS['TL_HOOKS']['tasksModifyStatusOptions'][]          = array('TaskHooks', 'checkStatusOptions');
$GLOBALS['TL_HOOKS']['tasksModifyProgressOptions'][]        = array('TaskHooks', 'checkProgressOptions');
$GLOBALS['TL_HOOKS']['tasksModifyTasktypeOptions'][]        = array('TaskHooks', 'checkTasktypeOptions');
$GLOBALS['TL_HOOKS']['tasksModifyPriorityOptions'][]        = array('TaskHooks', 'checkPriorityOptions');
$GLOBALS['TL_HOOKS']['tasksModifyTaskTableRow'][]           = array('TaskHooks', 'formatTaskTableRow');
$GLOBALS['TL_HOOKS']['tasksModifyTaskTableRow'][]           = array('TaskHooks', 'formatTaskTableRowDeadlineExceeded');
$GLOBALS['TL_HOOKS']['tasksModifyTaskStatusTableRows'][]    = array('TaskHooks', 'cleanTaskStatusTableRows');
$GLOBALS['TL_HOOKS']['tasksModifyTaskStatusTableRows'][]    = array('TaskHooks', 'formatTaskStatusTableRows');
$GLOBALS['TL_HOOKS']['tasksModifyTaskStatusHeaderFields'][] = array('TaskHooks', 'formatTaskStatusHeaderFields');
$GLOBALS['TL_HOOKS']['tasksModifyDefaultValue'][]           = array('TaskHooks', 'assignLoggedUserToBugs');

/**
 * Define special filters
 */
$GLOBALS['TL_TASK_SPECIALFILTER']['status_open']          = array('status NOT IN ("declined", "completed", "archived")', 0);
$GLOBALS['TL_TASK_SPECIALFILTER']['status_closed']        = array('status IN ("declined", "completed", "archived")', 0);
$GLOBALS['TL_TASK_SPECIALFILTER']['priority_important']   = array('priority > ?', 0);
$GLOBALS['TL_TASK_SPECIALFILTER']['priority_unimportant'] = array('priority < ?', 0);

/**
 * Define task defaults
 */
$GLOBALS['TL_TASK_DEFAULT']['tasktype']     = 'exercise';
$GLOBALS['TL_TASK_DEFAULT']['priority']     = 0;
$GLOBALS['TL_TASK_DEFAULT']['status']       = 'created';
$GLOBALS['TL_TASK_DEFAULT']['progress']     = 0;
$GLOBALS['TL_TASK_DEFAULT']['assignedUser'] = 0;

?>