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
$GLOBALS['TL_LANG']['tl_task']['id']          = array('ID', '');
$GLOBALS['TL_LANG']['tl_task']['tasktitle']   = array('Titel', 'Bitte geben Sie den Titel der Aufgabe ein.');
$GLOBALS['TL_LANG']['tl_task']['createdAt']   = array('Erstellt', 'Zeitstempel der Erstellung dieser Aufgabe.');
$GLOBALS['TL_LANG']['tl_task']['createdBy']   = array('Ersteller', 'Name des Benutzers, der diese Aufgabe erstellt hat.');
$GLOBALS['TL_LANG']['tl_task']['tasktype']    = array('Typ', 'Bitte wählen Sie den Typ der Aufgabe.');
$GLOBALS['TL_LANG']['tl_task']['priority']    = array('Priorität', 'Bitte wählen Sie die Priorität dieser Aufgabe.');
$GLOBALS['TL_LANG']['tl_task']['deadline']    = array('Endtermin', 'Bitte geben Sie einen Endtermin der Aufgabe ein.');
$GLOBALS['TL_LANG']['tl_task']['description'] = array('Beschreibung', 'Bitte geben Sie eine Beschreibung der Aufgabe ein.');
$GLOBALS['TL_LANG']['tl_task']['status']      = array('Status', '');
$GLOBALS['TL_LANG']['tl_task']['progress']    = array('Stand', '');
$GLOBALS['TL_LANG']['tl_task']['assignedTo']  = array('Zugewiesen an', '');

/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_task']['new']          = array('Neue Aufgabe', 'Eine neue Aufgabe erstellen');
$GLOBALS['TL_LANG']['tl_task']['edit']         = array('Aufgabedetails bearbeiten', 'Die Aufgabe ID %s direkt bearbeiten');
$GLOBALS['TL_LANG']['tl_task']['editheader']   = array('Aufgabedetails bearbeiten', 'Details der Aufgabe ID %s bearbeiten');
$GLOBALS['TL_LANG']['tl_task']['edit_history'] = array('Bearbeitungshistorie anzeigen', 'Die Bearbeitungshistorie der Aufgabe ID %s anzeigen');
$GLOBALS['TL_LANG']['tl_task']['delete']       = array('Aufgabe löschen', 'Die Aufgabe ID %s löschen');
$GLOBALS['TL_LANG']['tl_task']['show']         = array('Aufgabedetails', 'Details der Aufgabe ID %s anzeigen');

/**
 * Tasktype
 */
$GLOBALS['TL_LANG']['tl_task']['tasktype_values']['exercise']    = 'Aufgabe';
$GLOBALS['TL_LANG']['tl_task']['tasktype_values']['bug']         = 'Fehler';
$GLOBALS['TL_LANG']['tl_task']['tasktype_values']['feature']     = 'Neue Funktion';
$GLOBALS['TL_LANG']['tl_task']['tasktype_values']['improvement'] = 'Verbesserung';

/**
 * Priority
 */
$GLOBALS['TL_LANG']['tl_task']['priority_values']['2'] = 'sehr hoch';
$GLOBALS['TL_LANG']['tl_task']['priority_values']['1'] = 'hoch';
$GLOBALS['TL_LANG']['tl_task']['priority_values']['0'] = 'normal';
$GLOBALS['TL_LANG']['tl_task']['priority_values']['-1'] = 'niedrig';
$GLOBALS['TL_LANG']['tl_task']['priority_values']['-2'] = 'sehr niedrig';

/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_task']['taskdata_legend']    = 'Aufgabendaten';
$GLOBALS['TL_LANG']['tl_task']['dates_legend']       = 'Termine';
$GLOBALS['TL_LANG']['tl_task']['description_legend'] = 'Beschreibung';

/**
 * Misc
 */
$GLOBALS['TL_LANG']['tl_task']['specialFilter'] = 'Spezialfilter';

?>