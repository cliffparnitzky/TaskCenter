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
 * Notification email
 * Usable insert tags:
 *    - {{task::link}}          - replaced with the link to the in task center
 *    - {{task::id}}            - replaced with the id of the task
 *    - {{task::project}}       - replaced with the shortname of the project
 *    - {{task::creator}}       - replaced with the name of the user that created the task
 *    - {{task::title}}         - replaced with the title of the task
 *    - {{task::deadline}}      - replaced with the deadline (in global date format) of the task
 *    - {{task::type}}          - replaced with the type of the task
 *    - {{task::priority}}      - replaced with the priority of the task
 *    - {{task::assignedTo}}    - replaced with the name of the user, this task is assigned to
 *    - {{task::status}}        - replaced with the status of the task
 *    - {{task::progress}}      - replaced with the progress of the task
 *    - {{task::comment}}       - replaced with the last comment of the task
 *    - {{task::editor}}        - replaced with the name of the user that edited the task
 *    - {{task::creation_time}} - replaced with the datetime (in global datetime format) when the task was created
 *    - {{task::update_time}}   - replaced with the datetime (in global datetime format) when the task was updated
 */
$GLOBALS['TL_LANG']['tl_task_mail']['notification']['subject'] = '[TaskCenter - ' . $GLOBALS['TL_CONFIG']['websiteTitle'] . '] Erstellt, bearbeitet oder Ihnen zugewiesen: [{{task::project}}-{{task::id}}] {{task::title}}';
$GLOBALS['TL_LANG']['tl_task_mail']['notification']['plain'] = '
[{{task::project}}-{{task::id}}] {{task::title}}
{{task::link}}

Aktualisiert: {{task::update_time}} | Erstellt: {{task::creation_time}}

Die folgende Aufgabe wurde erstellt, bearbeitet oder Ihnen zugewiesen.

Aktualisiert von: {{task::editor}}
Datum: {{task::update_time}}

- Id          : {{task::id}}
- Projekt     : {{task::project}}
- Titel       : {{task::title}}
- Ersteller   : {{task::creator}}
- Erstellt    : {{task::creation_time}}
- Deadline    : {{task::deadline}}
- Aufgabentyp : {{task::type}}
- Priorität   : {{task::priority}}
- Bearbeiter  : {{task::assignedTo}}
- Status      : {{task::status}}
- Stand       : {{task::progress}}%
- Kommentar   : {{task::comment}}

Aufgabe Online anzeigen: {{task::link}}

Diese Email wurde automatisch erstellt durch "' . $GLOBALS['TL_CONFIG']['websiteTitle'] . '".
Wenn Sie der Meinung sind, dass Sie diese Email irrtümlich erhalten haben, wenden Sie sich bitte an ihren Systemadministrator (mailto:' . $GLOBALS['TL_CONFIG']['adminEmail'] . ').
';
$GLOBALS['TL_LANG']['tl_task_mail']['notification']['html'] = '
<html>
	<head>
		<style type="text/css">
			body, td {font-family: verdana; font-size: 12px;}
			td {vertical-align: top;}
			p {padding-top: 0px; margin-top: 0px;}
			.odd {background-color: #dfdfdf; #000000;}
			.even {background-color: #bfbfbf; color: #000000;}
			.taskAttribute {font-weight: bold; width: 20%;}
		</style>
	</head>
	<body>
		<font size="4"><a href="{{task::link}}">[{{task::project}}-{{task::id}}] {{task::title}}</a></font>
		<br/>
		<font size="1"><b>Aktualisiert:</b> {{task::update_time}} | <b>Erstellt:</b> {{task::creation_time}}</font>
		<br/><br/>
		Die folgende Aufgabe wurde erstellt, bearbeitet oder Ihnen zugewiesen.
		<br/><br/>
		<b>Aktualisiert von:</b> {{task::editor}}
		<br/>
		<b>Datum:</b> {{task::update_time}}
		<br/><br/>
		<table border="0" cellpadding="4" cellspacing="1" width="100%">
			<tr class="odd"><td class="taskAttribute">Id</td><td>{{task::id}}</td></tr>
			<tr class="even"><td class="taskAttribute">Projekt</td><td>{{task::project}}</td></tr>
			<tr class="odd"><td class="taskAttribute">Titel</td><td>{{task::title}}</td></tr>
			<tr class="even"><td class="taskAttribute">Ersteller</td><td>{{task::creator}}</td></tr>
			<tr class="odd"><td class="taskAttribute">Erstellt</td><td>{{task::creation_time}}</td></tr>
			<tr class="even"><td class="taskAttribute">Deadline</td><td>{{task::deadline}}</td></tr>
			<tr class="odd"><td class="taskAttribute">Aufgabentyp</td><td>{{task::type}}</td></tr>
			<tr class="even"><td class="taskAttribute">Priorität</td><td>{{task::priority}}</td></tr>
			<tr class="odd"><td class="taskAttribute">Bearbeiter</td><td>{{task::assignedTo}}</td></tr>
			<tr class="even"><td class="taskAttribute">Status</td><td>{{task::status}}</td></tr>
			<tr class="odd"><td class="taskAttribute">Stand</td><td>{{task::progress}}%</td></tr>
			<tr class="even"><td class="taskAttribute">Kommentar</td><td>{{task::comment}}</td></tr>
		</table>
		<br/><br/>
		Aufgabe Online anzeigen: <a href="{{task::link}}">{{task::link}}</a>
		<br/><br/>
		<font size="1">Diese Email wurde automatisch erstellt durch "' . $GLOBALS['TL_CONFIG']['websiteTitle'] . '".</font>
		<br/>
		<font size="1">Wenn Sie der Meinung sind, dass Sie diese Email irrtümlich erhalten haben, wenden Sie sich bitte an ihren <a href="mailto:' . $GLOBALS['TL_CONFIG']['adminEmail'] . '">Systemadministrator</a>.</font>
	</body>
</html>
';

?>