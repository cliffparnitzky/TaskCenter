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
$GLOBALS['TL_LANG']['tl_task_project']['name']             = array('Name', 'Please enter the name of the project.');;
$GLOBALS['TL_LANG']['tl_task_project']['shortname']        = array('Shortname', 'Please enter the short name of the project (unique name to identify the project).');
$GLOBALS['TL_LANG']['tl_task_project']['description']      = array('Description', 'Please enter the description for the project.');
$GLOBALS['TL_LANG']['tl_task_project']['url']              = array('Website', 'Please enter the website for the project.');
$GLOBALS['TL_LANG']['tl_task_project']['number']           = array('Number', 'Please enter an unique number for the project.');
$GLOBALS['TL_LANG']['tl_task_project']['manager']          = array('Manager', 'Please select the manager of the project.');
$GLOBALS['TL_LANG']['tl_task_project']['manager_deputy']   = array('Deputy of manager', 'Please select the deputy of the project manager.');
$GLOBALS['TL_LANG']['tl_task_project']['notifyManagement'] = array('Notify project management', 'Allow sending notification emails to project management, if not finished tasks reach the deadline.');
$GLOBALS['TL_LANG']['tl_task_project']['allowGroups']      = array('Allow groups', 'Please choose if this project should be accessible for user groups / member groups. If not selected, this project can only be used from administrators.');
$GLOBALS['TL_LANG']['tl_task_project']['userGroups']       = array('User groups', 'Please choose the user groups, which users are allowed to create, edit and delete tasks of this project. If no user grous are assigned to this project, it will only be visible for administrators.');
$GLOBALS['TL_LANG']['tl_task_project']['memberGroups']     = array('Member groups', 'Please choose the member groups, which members are allowed to create and see the tasks of this project in the frontend.');
$GLOBALS['TL_LANG']['tl_task_project']['published']        = array('Publish project', 'Publish this project, so tasks could be created for it.');
$GLOBALS['TL_LANG']['tl_task_project']['start']            = array('Publish project from', 'Publish this project from this day, so tasks could be created for it.');
$GLOBALS['TL_LANG']['tl_task_project']['stop']             = array('Publish project until', 'Publish this project until this day, to forbid creating tasks for it.');

/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_task_project']['project_legend']    = 'Project';
$GLOBALS['TL_LANG']['tl_task_project']['management_legend'] = 'Project management';
$GLOBALS['TL_LANG']['tl_task_project']['groups_legend']     = 'Project membership';
$GLOBALS['TL_LANG']['tl_task_project']['publish_legend']    = 'Publish settings';

/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_task_project']['new']    = array('New project', 'Create a new project');
$GLOBALS['TL_LANG']['tl_task_project']['show']   = array('Project details', 'Show the details of project ID %s');
$GLOBALS['TL_LANG']['tl_task_project']['edit']   = array('Edit project', 'Edit project ID %s');
$GLOBALS['TL_LANG']['tl_task_project']['copy']   = array('Duplicate project', 'Duplicate project ID %s');
$GLOBALS['TL_LANG']['tl_task_project']['delete'] = array('Delete project', 'Delete project ID %s');
$GLOBALS['TL_LANG']['tl_task_project']['toggle'] = array('Publish/unpublish project', 'Publish/unpublish project ID %s'); 

?>