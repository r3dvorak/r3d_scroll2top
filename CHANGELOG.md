# Changelog

Alle nennenswerten Aenderungen an diesem Projekt werden hier dokumentiert.

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
