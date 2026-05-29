# Changelog

All notable changes to this project are documented in this file.

## [6.0.3] - 2026-05-29

- Version uptick with SYS description update for a filtered Plugins Manager link.

## [6.0.2] - 2026-05-29

- Update Plugins Manager filter link to use R3D keyword.

## [6.0.1] - 2026-05-29

- Uptick after JED naming and package-cleanup fixes for re-test.
- Implemented JED checker fixes:
  - Added GPL notice in `script.php`.
  - Replaced deprecated filesystem import in `script.php` from `Joomla\CMS\Filesystem\File` to `Joomla\Filesystem\File`.
  - Cleaned EN/DE language files (removed duplicate keys, normalized string format, updated URLs to `extensions.r3d.de`).
- Updated manifest:
  - Plugin version set to `6.0.1`.
  - Update server path corrected to `r3d_scroll2top.xml`.
- Updated SYS language strings to JED naming convention for install name (`System - ...`).

## [5.3.8] - 2026-05-29

- Release uptick for live publishing on `extensions.r3d.de`.
- Kept new hover icon settings and Joomla update feed integration.

## [5.3.7] - 2026-05-29

- Added new icon hover settings:
  - `Icon hover color (SVG/Unicode)`
  - `Icon hover transparency`
- Extended runtime behavior: separate hover color handling for SVG/Unicode icons via CSS variables.
- Unified update-server feed URL on `extensions.r3d.de` path:
  - `https://extensions.r3d.de/extensions/r3d-scroll-to-top-button/pkg_r3d_scroll2top.xml`
- Extended installer script with uninstall cleanup for legacy language files.

## [5.3.6] - 2026-05-29

- Hardened compatibility for Joomla 4.4/5/6:
  - HTML response guards in `onAfterRender()` prevent injection into non-HTML outputs.
  - Defensive check against duplicate button injection.
- Added explicit minimum installation requirements:
  - `minimumJoomla = 4.4.0`
  - `minimumPhp = 8.1.0`
- Language fixes:
  - Corrected EN/DE plugin title mapping in `*.sys.ini`.
  - Updated EN/DE compatibility texts for Joomla 4.4/5/6.

## [5.3.5] - 2026-05-29

- Aligned project with standardized `_tools` workflow (`AGENTS.md`, `project.json`).
- Updated manifest update-server URL to new target:
  `https://extensions.r3d.de/extensions/r3d-scroll-to-top-button/r3d_scroll2top.xml`
- Bumped version values to `5.3.5`.

