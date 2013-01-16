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
$GLOBALS['TL_LANG']['tl_task_project']['name']             = array('Name', 'Bitte geben Sie den Namen für das Projekt ein.');;
$GLOBALS['TL_LANG']['tl_task_project']['shortname']        = array('Kurzname', 'Bitte geben Sie den Kurzname für das Projekt ein (eindeutiger Name zur Identifizierung des Projektes).');
$GLOBALS['TL_LANG']['tl_task_project']['description']      = array('Beschreibung', 'Bitte geben Sie eine Beschreibung für dieses Projekt ein.');
$GLOBALS['TL_LANG']['tl_task_project']['url']              = array('Webseite', 'Bitte geben Sie eine Webseite für dieses Projekt ein.');
$GLOBALS['TL_LANG']['tl_task_project']['number']           = array('Nummer', 'Bitte geben Sie eine eindeutige Nummer für dieses Projekt ein.');
$GLOBALS['TL_LANG']['tl_task_project']['manager']          = array('Projektleiter', 'Bitte wählen Sie den Projektleiter für dieses Projekt.');
$GLOBALS['TL_LANG']['tl_task_project']['manager_deputy']   = array('Vertreter des Projektleiters', 'Bitte wählen Sie den Vertreter des Projektleiters.');
$GLOBALS['TL_LANG']['tl_task_project']['notifyManagement'] = array('Projektleitung benachrichtigen', 'Bitte wählen Sie ob das Management per Email benachrichtigt werden soll, wenn der Endtermin einer unfertigen Aufgabe erreicht ist.');
$GLOBALS['TL_LANG']['tl_task_project']['allowGroups']      = array('Gruppen erlauben', 'Bitte wählen Sie ob das Projekt für Benutzer- / Mitgliedergruppen zugänglich sein sollten. Wenn nicht selektiert, kann dieses Projekt nur von Administratoren genutzt werden.');
$GLOBALS['TL_LANG']['tl_task_project']['userGroups']       = array('Benutzergruppen', 'Bitte wählen Sie die Benutzergruppen für dieses Projekt, dessen Benutzer Aufgaben in dem Projekt anlegen, bearbeiten und löschen können. Wenn dem Projekt keine Benutzergruppen zugeordnet sind, ist es nur für Administratoren sichtbar.');
$GLOBALS['TL_LANG']['tl_task_project']['memberGroups']     = array('Mitgliedergruppen', 'Bitte wählen Sie die Mitgliedergruppen für dieses Projekt, dessen Mitglieder Aufgaben im Frontend anlegen und einsehen können.');
$GLOBALS['TL_LANG']['tl_task_project']['published']        = array('Projekt veröffentlichen', 'Das Projekt veröffentlichen und somit das Anlegen von Aufgaben ermöglichen.');
$GLOBALS['TL_LANG']['tl_task_project']['start']            = array('Projekt veröffentlichen ab', 'Das Projekt erst ab diesem Tag veröffentlichen und somit das Anlegen von Aufgaben ermöglichen.');
$GLOBALS['TL_LANG']['tl_task_project']['stop']             = array('Projekt veröffentlichen bis', 'Das Projekt nur bis zu diesem Tag veröffentlichen und somit das Anlegen von Aufgaben verbieten.');

/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_task_project']['project_legend']    = 'Projekt';
$GLOBALS['TL_LANG']['tl_task_project']['management_legend'] = 'Projektleitung';
$GLOBALS['TL_LANG']['tl_task_project']['groups_legend']     = 'Projektzugehörigkeit';
$GLOBALS['TL_LANG']['tl_task_project']['publish_legend']    = 'Veröffentlichung';

/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_task_project']['new']    = array('Neues Projekt', 'Ein neues Projekt anlegen');
$GLOBALS['TL_LANG']['tl_task_project']['show']   = array('Projektdetails', 'Details des Projekts ID %s anzeigen');
$GLOBALS['TL_LANG']['tl_task_project']['edit']   = array('Projekt bearbeiten', 'Projekt ID %s bearbeiten');
$GLOBALS['TL_LANG']['tl_task_project']['copy']   = array('Projekt duplizieren', 'Projekt ID %s duplizieren');
$GLOBALS['TL_LANG']['tl_task_project']['delete'] = array('Projekt löschen', 'Projekt ID %s löschen');
$GLOBALS['TL_LANG']['tl_task_project']['toggle'] = array('Projekt veröffentlichen/unveröffentlichen', 'Projekt ID %s veröffentlichen/unveröffentlichen');

?>