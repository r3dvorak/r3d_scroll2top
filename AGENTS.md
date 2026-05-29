# AGENTS

## Projektregeln

- Joomla-Projektregeln aus `D:\1DEV\_tools\JOOMLA_PROJECT_RULES.md` sind verbindlich
- Codex-Workflowregeln aus `D:\1DEV\_tools\AGENTS.md` sind verbindlich
- Keine Core-Hacks in Joomla
- Pfade in Joomla-Artefakten immer mit `/`

## Arbeitsmodus

- `project.json` ist die Source of Truth fuer Metadaten und Build-Parameter
- Struktur und Build folgen strikt dem `D:\1DEV\_tools`-Flow
- Verzeichnisreihenfolge bleibt: `01_src -> 02_build -> 03_docs -> 04_dist -> 05_updates`
- Release- und Publish-Schritte erfolgen ueber die `_tools`-Skripte

## Release & Publish

- Standard: Uptick nach SemVer, ausser explizit `kein uptick`
- Commit-Messages beginnen mit `vX.Y.Z`
- Nach Commit: Push
- Bei Versionsaenderung: gleichlautenden Tag erzeugen und pushen
- GitHub Release zum Tag erstellen oder aktualisieren
- Publish-Ziel fuer Extensions: `https://extensions.r3d.de/extensions/`
