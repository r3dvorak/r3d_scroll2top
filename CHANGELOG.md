# Changelog

Alle nennenswerten Aenderungen an diesem Projekt werden hier dokumentiert.

## [6.0.2] - 2026-05-29

- Uptick with Plugins Manager filtered-link text update in SYS descriptions.

## [6.0.1] - 2026-05-29

- Uptick after JED naming and package-cleanup fixes for re-test.
- JED-Checker-Fixes umgesetzt:
  - GPL-Hinweis in `script.php` ergaenzt.
  - Deprecated-Import in `script.php` von `Joomla\CMS\Filesystem\File` auf `Joomla\Filesystem\File` umgestellt.
  - Sprachdateien EN/DE bereinigt (duplizierte Keys entfernt, String-Format vereinheitlicht, URLs auf `extensions.r3d.de` aktualisiert).
- Manifest aktualisiert:
  - Plugin-Version auf `6.0.1`.
  - Update-Server-Pfad auf `r3d_scroll2top.xml` korrigiert.
- Sys-Sprachstrings auf JED-Namenskonvention fuer den Installnamen angepasst (`System - ...`).

## [5.3.8] - 2026-05-29

- Release-Uptick fuer Live-Publish auf `extensions.r3d.de`.
- Beibehaltung der neuen Hover-Icon-Einstellungen sowie Joomla-Update-Feed-Anbindung.

## [5.3.7] - 2026-05-29

- Neue Einstellungsoptionen fuer Icon-Hoverzustand:
  - `Icon hover color (SVG/Unicode)`
  - `Icon hover transparency`
- Runtime erweitert: separates Hover-Farbverhalten fuer SVG/Unicode-Icon via CSS-Variablen.
- Update-Server-Feed-URL auf `extensions.r3d.de`-Pfad vereinheitlicht:
  - `https://extensions.r3d.de/extensions/r3d-scroll-to-top-button/pkg_r3d_scroll2top.xml`
- Installer-Script um Uninstall-Cleanup fuer Legacy-Sprachdateien erweitert.

## [5.3.6] - 2026-05-29

- Kompatibilitaet fuer Joomla 4.4/5/6 gehaertet:
  - HTML-Response-Guards in `onAfterRender()` verhindern Injection in Nicht-HTML-Ausgaben.
  - Defensiver Check gegen doppelte Button-Injektion.
- Explizite Installations-Mindestanforderungen ergaenzt:
  - `minimumJoomla = 4.4.0`
  - `minimumPhp = 8.1.0`
- Sprachkorrekturen:
  - `*.sys.ini` EN/DE Plugin-Titel-Zuordnung korrigiert.
  - Kompatibilitaetstexte in EN/DE auf Joomla 4.4/5/6 aktualisiert.

## [5.3.5] - 2026-05-29

- Projekt auf standardisierten `_tools`-Workflow ausgerichtet (`AGENTS.md`, `project.json`).
- Update-Server-URL im Manifest auf neues Ziel umgestellt:
  `https://extensions.r3d.de/extensions/r3d-scroll-to-top-button/r3d_scroll2top.xml`
- Versionswerte auf `5.3.5` angehoben.




