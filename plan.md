* Ersteller eines Komentar
	- Anzeige in der Aufgabenhistorie
	- Issue: http://dev.contao.org/issues/1701
* Feld: 'Stand'
	- im Filter
* Feld: 'Status'
	- weiterer Wert: Analysiert (per DCA)
	- im Specialfilter (Mehrfachauswahl möglich, Issue: http://dev.contao.org/issues/1275)
* neues Feld: 'Prioritäten'
	- Werte: sehr hoch, hoch, normal, niedrig, sehr niedrig
	- mit entsprechenden Icons
	- Anzeige in der Liste
	- Ändern im Formular
	- im Specialfilter (Mehrfachauswahl möglich)
	- Erweiterung per DCA
* neues Feld: 'Aufgabentyp'
	- Werte: Fehler / Bug, Verbesserung / Improvement, Aufgabe / Exercise, Neue Funktion / New Feature
	- Anzeige in der Liste
	- Ändern im Formular
	- im Specialfilter (Mehrfachauswahl möglich)
	- Erweiterung per DCA
* Feld: 'Kommentar'
	- Tiny Editor für den Text (eigene Tiny Definition: ohne 'newdocument', mit 'hr'/'strikethrough')
	- Issue: http://dev.contao.org/issues/1275
* Systemeinstellungen
	- Default Selektion von "Benutzer benachrichtigen" (Issue: http://dev.contao.org/issues/1275)
* Feld: 'Id'
	- Anzeige in der Liste
	- im Filter
	- in der Suche
* Filter wird nach Wertwechsel ausgelöst (onChange Event)
* Style (CSS Klasse / CSS Style) für jeweiligen Status oder "Dealine erreicht" wird per DCA definiert
  - kann in system/config/dcaconfig.php angepasst werden
* Feld: 'Übertragen an'
	- ist nicht mehr vorbelegt -> explizite Auswahl eines Benutzers
* Anpassung Notification Mail
  - keine Email an sich selbst (aktuelles Benutzer = Bearbeiter -> keine NotificationMail)
  - Mailtext per Sprachdatei definier- bzw. anpassbar ($GLOBALS['TL_LANG']['tl_task_mail']['notification'])
	- Backendsprache des Empfängers definiert die Mailsprache
	- Angaben von HTML und Plain Text
	- Ausgabe aller Aufgabe Attribute mittels Insert Tags (Dokumentiert in der Sprachdatei)
* Detailseite zum Anzeigen eines Aufgabe im Nur-Lese-Modus
  - Anzeige der Daten inkl. letzter Aktualisierung, sowie kompletter Bearbeitungshistorie
  - Verknüpfung in den Emails auf die Detailsseite
	- Button in der Aufgabenliste
* Einbindung als separaten Zweig im Backend Baum
	- Task Center
		- Aufgaben
		- Projekte
* Projektverwaltung
  - Anlegen von Projekten mit Name, Kurzname, Projektleiter uvm.
	- Einbindung Projekt in Aufgabe (nur veröffentlichte Projekte können benutzt werden)
* Sortierung mit Contao Standard Widget
* Task Center nur für bestimmte Benutzergruppen konfigurieren
	- in den Benutzergruppeneinstellungen kann das Task Center aktiviert bzw. deaktiviert werden
	- Link: http://www.contao-community.de/showthread.php?11672-Backend-Module-f%FCr-Benutzer-bzw.-Benutzergruppen-einschr%E4nken&highlight=task+center
* Benutzereinstellungen
  - Email an sich selbst (wenn ich Bearbeiter eine Aufgabe und Kommentarverfasser)
	- Sortierung der Bearbeitungshistorie (http://www.contao-community.de/showthread.php?15005-Im-Task-Center-die-Bearbeitungshistorie-anders-rum-darstellen&highlight=task+center)
	- sichtbare Spalten in der Übersichtstabelle
  - Verwendung von Kurznamen in der Spaltenüberschriften der Übersichtstabelle
	- Verwendung von Icon statt Text in der Übersichtstabelle für Aufgabentyp, Priorität und Status
	- Auswahl des Iconsets für Prioritäten (Flaggen, Pfeile)
* Buttons für mehr Funktionen in den Erstell- / Editier-Masken
  - Aufgaben erstellen: "Erstellen", "Erstellen und bearbeiten", "Erstellen und neu"
	- Aufgaben bearbeiten: "Aktualisieren", "Aktualisieren und schließen"

Undefined
---------

- Erweiterung um Job, der täglich 1 x prüft, für welche Tasks die Dealine erreicht ist und dann eine Email an den Bearbeiter schickt
	- Ausführung: täglich per CRON Job
	- Inhalt für HTML und Text Mail in DCA Konfiguriert
	- in Einstellungen definierbar, ob Job ausgeführt werden soll
	- in Einstellungen definierbar, wann die Mail rausgehen soll: 1 Woche vorher, 1 Tag vorher, am Tag der Dealine (per DCA um zusätzlich Werte erweiterbar ???)
- Aufgaben für Benutzergruppen sichtbar, bearbeitbar, entsprechend Projektkonfiguration
  - Matrix erstellen
- Dateianhänge
	- Issue: http://dev.contao.org/issues/1275
- Anpassung Startseite
  - Hook: parseBackendTemplate 
- Email wenn Aufgabe gelöscht an letzten Bearbeiter und Projektleitung --> ggf. per Extra Extension --> Hooks für create, update and delete task einfügen
- FE Modul zum Erfassen von Aufgaben
  - erlaubte Mitgliedergruppen im Projekt definieren
	- FE Modul
   - Projekt (bietet eingeloggtem Mitglied nur veröffentlichte Projekte an, die für seine Mitgliedergruppen definiert sind)
	 - Titel, Endtermin, Aufgabentyp, Priorität, Kommentar
	 - wird automatisch dem Projektleiter zugewiesen --> automatisch per Mail benachrichigen
	 - Tiny für Kommentar: http://www.contao-community.de/showthread.php?551-Smileys-im-Kommentar-Modul-%28ContentComments.php%29
- Öffentlichkeitsstatus des Projektes in der BE Liste der Tasks anzeigen als Icon
- Überlegen was mit Aufgaben ist, wenn das Projekt nicht veröffentlicht ist, bzgl. bearbeiten und löschen
- Systemeinstellung
	- Löschen von Aufgaben verbieten --> blendet Button "delete" aus
	- Vorgaben von Folgezustände
	- Definition, welche Operationen in welchem Status möglich sind (z.B. ARCHIVED --> keine Edit)
- was passiert mit Projekt wenn Aufgaben dran hängen, bzw. was passiert mit Aufgaben, wenn Projekt gelöscht wird
- Benutzereinstellungen
	- Initialisierung der Spalte nach Installation --> default Wert?
- Projekt
  - Projektzugehörigkeit: Gruppen erlauben --> Subpalette mit Benutzergruppen / Mitgliedergruppen (Benutzergruppen = mandatory) ... muss noch ausgewertet werden
- Status Variablen entsprechend der Reihenfolge wie sie vorkommen sortieren
- Projekte für Mitgliedergruppe erlauben, aber nicht für Benutzergruppe ??? ---> JA, Adminprojekt, was Issues aus dem FE erhalten kann
- Link für Tiny zum Tasks

Fehler
------

- Änderung der Deadline wird nicht in Email angezeigt
- Fehler im Toggel wenn Datum gesetzt bei der Projektverwaltung