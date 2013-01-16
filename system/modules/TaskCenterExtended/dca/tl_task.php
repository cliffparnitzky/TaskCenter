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
 * Table tl_task
 */
$GLOBALS['TL_DCA']['tl_task']['fields']['comment']['eval']['rte'] = 'tinyTask';

/**
 * Define styles / classes for each state
 * e.g.
 *  $GLOBALS['TL_DCA']['tl_task_status']['created']['style']   = 'color: #00ff00;';
 *  $GLOBALS['TL_DCA']['tl_task_status']['completed']['class'] = 'completed';
 */
$GLOBALS['TL_DCA']['tl_task_status']['created']['style']   = 'color: #D68C23;';
$GLOBALS['TL_DCA']['tl_task_status']['completed']['class'] = 'completed';

/**
 * Define styles / classes for task, that reached the deadline
 * e.g.
 *  $GLOBALS['TL_DCA']['tl_task']['deadline']['style'] = 'font-color: #00ff00;';
 *  $GLOBALS['TL_DCA']['tl_task']['deadline']['class'] = 'completed';
 */
$GLOBALS['TL_DCA']['tl_task']['deadline']['style'] = 'font-weight: bold;';
$GLOBALS['TL_DCA']['tl_task']['deadline']['class'] = 'due';

?>