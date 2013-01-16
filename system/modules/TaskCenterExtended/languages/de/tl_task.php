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
$GLOBALS['TL_LANG']['tl_task']['project']             = array('Projekt', 'Bitte wählen Sie das Projekt für diese Aufgabe.');
$GLOBALS['TL_LANG']['tl_task']['project']['short']    = 'Projekt';
$GLOBALS['TL_LANG']['tl_task']['projectName']         = $GLOBALS['TL_LANG']['tl_task']['project'][0];
$GLOBALS['TL_LANG']['tl_task']['tasktype']            = array('Aufgabentyp', 'Bitte wählen Sie den Typ für diese Aufgabe.');
$GLOBALS['TL_LANG']['tl_task']['tasktype']['short']   = 'Typ';
$GLOBALS['TL_LANG']['tl_task']['title']['short']      = 'Titel';
$GLOBALS['TL_LANG']['tl_task']['assignedTo']          = array('Bearbeiter');;
$GLOBALS['TL_LANG']['tl_task']['assignedTo']['short'] = 'Bearbeiter';
$GLOBALS['TL_LANG']['tl_task']['priority']            = array('Priorität', 'Bitte wählen Sie die Priorität für diese Aufgabe.');
$GLOBALS['TL_LANG']['tl_task']['priority']['short']   = 'Prio';
$GLOBALS['TL_LANG']['tl_task']['status']['short']     = 'Status';
$GLOBALS['TL_LANG']['tl_task']['progress']['short']   = 'Stand';
$GLOBALS['TL_LANG']['tl_task']['deadline']            = array('Endtermin', 'Bitte wählen Sie den Endtermin für diese Aufgabe.');
$GLOBALS['TL_LANG']['tl_task']['deadline']['short']   = 'Ende';

/**
 * Labels for last update for detail page
 */
$GLOBALS['TL_LANG']['tl_task']['lastUpdate']     = 'Letzte Aktualisierung';
$GLOBALS['TL_LANG']['tl_task']['lastUpdateUser'] = 'Aktualisiert von';
$GLOBALS['TL_LANG']['tl_task']['lastUpdateTime'] = 'Aktualisiert am';

 /**
 * Priority
 */
$GLOBALS['TL_LANG']['tl_task_priority']['5_very_high'] = 'sehr hoch';
$GLOBALS['TL_LANG']['tl_task_priority']['4_high']      = 'hoch';
$GLOBALS['TL_LANG']['tl_task_priority']['3_normal']    = 'normal';
$GLOBALS['TL_LANG']['tl_task_priority']['2_low']       = 'niedrig';
$GLOBALS['TL_LANG']['tl_task_priority']['1_very_low']  = 'sehr niedrig';

/**
 * Type
 */
$GLOBALS['TL_LANG']['tl_task_tasktype']['exercise']    = 'Aufgabe';
$GLOBALS['TL_LANG']['tl_task_tasktype']['bug']         = 'Fehler';
$GLOBALS['TL_LANG']['tl_task_tasktype']['new_feature'] = 'Neue Funktion';
$GLOBALS['TL_LANG']['tl_task_tasktype']['improvement'] = 'Verbesserung';

/**
 * Status
 */
$GLOBALS['TL_LANG']['tl_task_status']['analysed']  = 'Analysiert';
$GLOBALS['TL_LANG']['tl_task_status']['suspended'] = 'Angehalten';
$GLOBALS['TL_LANG']['tl_task_status']['archived']  = 'Archiviert';

/**
 * Submit buttons
 */
$GLOBALS['TL_LANG']['tl_task']['createSubmit']        = 'Erstellen';
$GLOBALS['TL_LANG']['tl_task']['createSubmitAndEdit'] = 'Erstellen und bearbeiten';
$GLOBALS['TL_LANG']['tl_task']['createSubmitAndNew']  = 'Erstellen und neu';
$GLOBALS['TL_LANG']['tl_task']['editSubmit']          = 'Aktualisieren';
$GLOBALS['TL_LANG']['tl_task']['editSubmitAndClose']  = 'Aktualisieren und schließen';

/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_task']['show'] = array('Aufgabe anzeigen', 'Die Aufgabe ID %s anzeigen');

/**
 * Filter label
 */
$GLOBALS['TL_LANG']['tl_task']['special_filter'] = "Spezialfilter";

/**
 * Select options for history sort order
 */
$GLOBALS['TL_LANG']['tl_task']['historySortOrder']['ASC']  = '&#8595; Letzte Aktualisierung unten';
$GLOBALS['TL_LANG']['tl_task']['historySortOrder']['DESC'] = '&#8593; Letzte Aktualisierung oben';

?>