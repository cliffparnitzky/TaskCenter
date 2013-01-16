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
$GLOBALS['TL_LANG']['tl_user']['taskcenterEmailToYourself']       = array('Emails an sich selbst senden', 'Bitte wählen Sie, ob eine Email an Sie versand werden soll, wenn Sie Bearbeiter einer Aufgabe sind, dazu ein Kommentar verfassen und <b>Benutzer benachrichtigen</b> markiert ist.');
$GLOBALS['TL_LANG']['tl_user']['taskcenterHistorySorting']        = array('Sortierung der Bearbeitungshistorie', 'Bitte wählen Sie, wie die Bearbeitungshistorie sortiert sein soll.');
$GLOBALS['TL_LANG']['tl_user']['taskcenterColumnsShortnameUsage'] = array('Spaltenüberschriften mit Kurznamen', 'Bitte wählen Sie, ob für die Spaltenüberschriften der Übersichtstabelle Kurznamen verwendet werden sollen.');
$GLOBALS['TL_LANG']['tl_user']['taskcenterColumnsVisibility']     = array('Sichtbare Tabellenspalten', 'Bitte wählen Sie hier, welche Spalten in der Übersichtstabelle des Task Center sichtbar sein sollen.');
$GLOBALS['TL_LANG']['tl_user']['taskcenterIconUsage']             = array('Icon Nutzung', 'Bitte wählen Sie ob für ' . $GLOBALS['TL_LANG']['tl_task']['tasktype'][0] . ', ' . $GLOBALS['TL_LANG']['tl_task']['priority'][0] . ' und ' . $GLOBALS['TL_LANG']['tl_task']['status'][0] . ' der Aufgaben statt dem Text ein Icon (inkl. ausführlichem Tooltip) in der Übersichtstabelle angezeigt werden soll.');
$GLOBALS['TL_LANG']['tl_user']['taskcenterIconPriorityIconSet']   = array('Iconset für Prioritäten', 'Bitte wählen Sie welches Iconset für die Prioritätsicons verwendet werden soll.');

/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_user']['taskcenter_legend'] = 'Task Center';

/**
 * Select/Checkbox values
 */
$GLOBALS['TL_LANG']['tl_user']['taskcenterIconPriorityIconSet']['flags'] = array('Flaggen', 'Zum Symbolisieren der einzelnen Prioritätsstufen werden die folgenden Flaggen verwendet:<ul>'
																		. '<li><img src="system/modules/TaskCenterExtended/html/priority_flag_5_very_high" alt="' . $GLOBALS['TL_LANG']['tl_task_priority']['5_very_high'] . '" title="' . $GLOBALS['TL_LANG']['tl_task_priority']['5_very_high'] . '" /> ' . $GLOBALS['TL_LANG']['tl_task_priority']['5_very_high'] . '</li>'
																		. '<li><img src="system/modules/TaskCenterExtended/html/priority_flag_4_high" alt="' . $GLOBALS['TL_LANG']['tl_task_priority']['4_high'] . '" title="' . $GLOBALS['TL_LANG']['tl_task_priority']['4_high'] . '" /> ' . $GLOBALS['TL_LANG']['tl_task_priority']['4_high'] . '</li>'
																		. '<li><img src="system/modules/TaskCenterExtended/html/priority_flag_3_normal" alt="' . $GLOBALS['TL_LANG']['tl_task_priority']['3_normal'] . '" title="' . $GLOBALS['TL_LANG']['tl_task_priority']['3_normal'] . '" /> ' . $GLOBALS['TL_LANG']['tl_task_priority']['3_normal'] . '</li>'
																		. '<li><img src="system/modules/TaskCenterExtended/html/priority_flag_2_low" alt="' . $GLOBALS['TL_LANG']['tl_task_priority']['2_low'] . '" title="' . $GLOBALS['TL_LANG']['tl_task_priority']['2_low'] . '" /> ' . $GLOBALS['TL_LANG']['tl_task_priority']['2_low'] . '</li>'
																		. '<li><img src="system/modules/TaskCenterExtended/html/priority_flag_1_very_low" alt="' . $GLOBALS['TL_LANG']['tl_task_priority']['1_very_low'] . '" title="' . $GLOBALS['TL_LANG']['tl_task_priority']['1_very_low'] . '" /> ' . $GLOBALS['TL_LANG']['tl_task_priority']['1_very_low'] . '</li>'
																		. '</ul>');
$GLOBALS['TL_LANG']['tl_user']['taskcenterIconPriorityIconSet']['arrows'] = array('Pfeile', 'Zum Symbolisieren der einzelnen Prioritätsstufen werden die folgenden Pfeile verwendet:<ul>'
																		. '<li><img src="system/modules/TaskCenterExtended/html/priority_arrow_5_very_high" alt="' . $GLOBALS['TL_LANG']['tl_task_priority']['5_very_high'] . '" title="' . $GLOBALS['TL_LANG']['tl_task_priority']['5_very_high'] . '" /> ' . $GLOBALS['TL_LANG']['tl_task_priority']['5_very_high'] . '</li>'
																		. '<li><img src="system/modules/TaskCenterExtended/html/priority_arrow_4_high" alt="' . $GLOBALS['TL_LANG']['tl_task_priority']['4_high'] . '" title="' . $GLOBALS['TL_LANG']['tl_task_priority']['4_high'] . '" /> ' . $GLOBALS['TL_LANG']['tl_task_priority']['4_high'] . '</li>'
																		. '<li><img src="system/modules/TaskCenterExtended/html/priority_arrow_3_normal" alt="' . $GLOBALS['TL_LANG']['tl_task_priority']['3_normal'] . '" title="' . $GLOBALS['TL_LANG']['tl_task_priority']['3_normal'] . '" /> ' . $GLOBALS['TL_LANG']['tl_task_priority']['3_normal'] . '</li>'
																		. '<li><img src="system/modules/TaskCenterExtended/html/priority_arrow_2_low" alt="' . $GLOBALS['TL_LANG']['tl_task_priority']['2_low'] . '" title="' . $GLOBALS['TL_LANG']['tl_task_priority']['2_low'] . '" /> ' . $GLOBALS['TL_LANG']['tl_task_priority']['2_low'] . '</li>'
																		. '<li><img src="system/modules/TaskCenterExtended/html/priority_arrow_1_very_low" alt="' . $GLOBALS['TL_LANG']['tl_task_priority']['1_very_low'] . '" title="' . $GLOBALS['TL_LANG']['tl_task_priority']['1_very_low'] . '" /> ' . $GLOBALS['TL_LANG']['tl_task_priority']['1_very_low'] . '</li>'
																		. '</ul>');
?>