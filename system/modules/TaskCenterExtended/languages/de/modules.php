<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/**
 * Contao Open Source CMS
 * Copyright (C) 2011 Cliff Parnitzky
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
 * Define name and tooltip for preferences (inactive modules)
 */
$GLOBALS['TL_LANG']['MOD']['TaskCenterExtended'] = array('Task Center (erweitert)', 'Erweitertes Task Center');
$GLOBALS['TL_LANG']['MOD']['taskcenter']         = 'Task Center';
$GLOBALS['TL_LANG']['MOD']['tasks']              = array('Aufgaben', 'Aufgaben erfassen und Benutzern zuweisen.');
$GLOBALS['TL_LANG']['MOD']['projects']           = array('Projekte', 'Projekte anlegen, denen Aufgaben zugewiesen werden können.');

/**
 * Define name and tooltip for modul selection
 */
$GLOBALS['TL_LANG']['FMD']['taskcenter']    = $GLOBALS['TL_LANG']['MOD']['taskcenter']; 
$GLOBALS['TL_LANG']['FMD']['task_creation'] = array('Aufgabenerfassung', 'Stellt eine Eingabemaske zur Erfassung von Aufgaben zur Verfügung.'); 
$GLOBALS['TL_LANG']['FMD']['task_listing']  = array('Aufgabenauflistung', 'Stellt eine Liste der Aufgaben zur Verfügung.'); 

?>