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
 * Fields
 */
$GLOBALS['TL_LANG']['tl_task_status']['createdAt']        = array('Erstellt', 'Zeitstempel der Erstellung dieses Bearbeitungsschritts.');
$GLOBALS['TL_LANG']['tl_task_status']['createdBy']        = array('Ersteller', 'Name des Benutzers, der diesen Bearbeitungsschritts erstellt hat.');
$GLOBALS['TL_LANG']['tl_task_status']['task_title']       = array('Titel der Aufgabe', 'Der Titel der Aufgabe (nur lesend).');
$GLOBALS['TL_LANG']['tl_task_status']['task_description'] = array('Beschreibung der Aufgabe', 'Die Beschreibung der Aufgabe (nur lesend).');
$GLOBALS['TL_LANG']['tl_task_status']['status']           = array('Status', 'Hier können Sie den Bearbeitungsstatus auswählen.');
$GLOBALS['TL_LANG']['tl_task_status']['progress']         = array('Stand', 'Hier können Sie den Bearbeitungsstand in Prozent festlegen.');
$GLOBALS['TL_LANG']['tl_task_status']['assignedTo']       = array('Zugewiesen an', 'Hier können Sie die Aufgabe einem Benutzer zuweisen.');
$GLOBALS['TL_LANG']['tl_task_status']['comment']          = array('Kommentar', 'Hier können Sie einen Kommentar hinzufügen.');

/**
 * Status
 */
$GLOBALS['TL_LANG']['tl_task_status']['status_values']['created']    = array('Erstellt', '');
$GLOBALS['TL_LANG']['tl_task_status']['status_values']['analysed']   = array('Analysiert', '');
$GLOBALS['TL_LANG']['tl_task_status']['status_values']['declined']   = array('Abgelehnt', '');
$GLOBALS['TL_LANG']['tl_task_status']['status_values']['processing'] = array('In Bearbeitung', '');
$GLOBALS['TL_LANG']['tl_task_status']['status_values']['reviewing']  = array('In Überprüfung', '');
$GLOBALS['TL_LANG']['tl_task_status']['status_values']['suspended']  = array('Angehalten', '');
$GLOBALS['TL_LANG']['tl_task_status']['status_values']['forwarded']  = array('Weitergeleitet', '');
$GLOBALS['TL_LANG']['tl_task_status']['status_values']['completed']  = array('Fertig', 'Aufgaben in diesem Status gelten als erledigt.');
$GLOBALS['TL_LANG']['tl_task_status']['status_values']['archived']   = array('Archiviert', 'Aufgaben in diesem Status können nicht weiter bearbeitet werden.');

/**
 * Progress
 */
$GLOBALS['TL_LANG']['tl_task_status']['progress_values'][0]   = "0 %";
$GLOBALS['TL_LANG']['tl_task_status']['progress_values'][10]  = "10 %";
$GLOBALS['TL_LANG']['tl_task_status']['progress_values'][20]  = "20 %";
$GLOBALS['TL_LANG']['tl_task_status']['progress_values'][30]  = "30 %";
$GLOBALS['TL_LANG']['tl_task_status']['progress_values'][40]  = "40 %";
$GLOBALS['TL_LANG']['tl_task_status']['progress_values'][50]  = "50 %";
$GLOBALS['TL_LANG']['tl_task_status']['progress_values'][60]  = "60 %";
$GLOBALS['TL_LANG']['tl_task_status']['progress_values'][70]  = "70 %";
$GLOBALS['TL_LANG']['tl_task_status']['progress_values'][80]  = "80 %";
$GLOBALS['TL_LANG']['tl_task_status']['progress_values'][90]  = "90 %";
$GLOBALS['TL_LANG']['tl_task_status']['progress_values'][100] = "100 %";

/**
 * Submit buttons
 */
$GLOBALS['TL_LANG']['tl_task_status']['createSubmit'] = 'Die Aufgabe erstellen';
$GLOBALS['TL_LANG']['tl_task_status']['editSubmit']   = 'Die Aufgabe aktualisieren';

/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_task_status']['new']    = array('Aufgabe bearbeiten', 'Einen neuen Bearbeitungsschritt anlegen');
$GLOBALS['TL_LANG']['tl_task_status']['edit']   = array('Bearbeitungsschritt bearbeiten', 'Den Bearbeitungsschritt ID %s bearbeiten');
$GLOBALS['TL_LANG']['tl_task_status']['delete'] = array('Bearbeitungsschritt löschen', 'Den Bearbeitungsschritt ID %s löschen');
$GLOBALS['TL_LANG']['tl_task_status']['show']   = array('Bearbeitungsschritt anzeigen', 'Den Bearbeitungsschritt ID %s anzeigen');

/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_task_status']['task_legend']    = 'Aufgabendaten';
$GLOBALS['TL_LANG']['tl_task_status']['state_legend']   = 'Bearbeitungsstand';
$GLOBALS['TL_LANG']['tl_task_status']['assign_legend']  = 'Zuweisung';
$GLOBALS['TL_LANG']['tl_task_status']['comment_legend'] = 'Kommentar';

?>