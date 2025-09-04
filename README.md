# R3D Scroll To Top (Joomla 5 System Plugin)

[![License: GPL v3](https://img.shields.io/badge/License-GPLv3-blue.svg)](https://www.gnu.org/licenses/gpl-3.0.html)

Lightweight Joomla 5 **system plugin** that adds a configurable, accessible “Scroll to top” button.  
No jQuery. Small footprint. PHP 8.2+. English & German language files included.

---

## ✨ Features

- **Icon options:** Unicode/emoji, inline SVG, or image
- **Placement:** bottom-right/bottom-left with X/Y offsets
- **Show threshold:** button appears after N px scroll
- **Smooth scrolling:** duration & easing (fallback to instant if disabled)
- **Keyboard accessible:** focusable control with ARIA label
- **`prefers-reduced-motion` aware:** disables animation for users who prefer less motion
- **Visibility rules:** desktop/mobile toggles
- **Styling hooks:** CSS class + high z-index for overlays
- **Localization:** en-GB / de-DE

---

## ✅ Requirements

- **Joomla** 5.3+  
- **PHP** 8.2+  
- Browser support: modern evergreen browsers

---

## 🚀 Installation

1. Download the ZIP from **Releases**.
2. In Joomla admin: **System → Install → Extensions** → upload the ZIP.
3. Enable the plugin: **System → Manage → Plugins → R3D Scroll To Top**.
4. Configure options (see below), then **Save & Close**.

---

## ⚙️ Configuration (key options)

- **Icon type:** Unicode / SVG / Image
- **Icon value / file:** character, SVG markup, or image path
- **Button size & padding:** width/height, inner spacing
- **Position:** bottom-right / bottom-left; **offset X/Y** (px)
- **Show after:** number of pixels scrolled before showing the button
- **Smooth scroll:** enable/disable, **duration (ms)**, **easing** (e.g., `easeInOutCubic`)
- **Z-Index:** bring above sticky headers/overlays
- **Device visibility:** show on desktop and/or mobile
- **ARIA label:** e.g., “Scroll to top”
- **Custom CSS class:** additional class for theming

> Tip: If your template already injects a “back to top,” disable one of them to avoid duplicates.

---

## 🧩 Template & Styling

The plugin renders a single fixed-position control. You can theme it via CSS:

```css
.r3d-scroll2top {
  /* example overrides */
  border-radius: 9999px;
  box-shadow: 0 2px 8px rgba(0,0,0,.2);
}
.r3d-scroll2top:focus-visible {
  outline: 2px solid currentColor;
  outline-offset: 2px;
}
@media (prefers-reduced-motion: reduce) {
  html:root {
    scroll-behavior: auto !important;
  }
}
