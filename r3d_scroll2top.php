<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  System.r3d_scroll2top
 * @creation    2025-08-28
 * @author      Richard Dvorak, r3d.de
 * @copyright   Copyright (C) 2025 Richard Dvorak, https://r3d.de
 * @license     GNU GPL v3 or later (https://www.gnu.org/licenses/gpl-3.0.html)
 * @version     5.1.1
 * @file        plugins/system/r3d_scroll2top/r3d_scroll2top.php
 */

declare(strict_types=1);

defined('_JEXEC') or die;

use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\CMS\Factory;

final class PlgSystemR3d_Scroll2top extends CMSPlugin
{
    public function onAfterRender(): void
    {
        $app = Factory::getApplication();

        // Nur im Frontend aktiv
        if ($app->isClient('administrator')) {
            return;
        }

        // Backend-Konfig holen
        $color = $this->params->get('color', '#222222');
        $position = $this->params->get('position', 'bottom-right');
        $size = (int) $this->params->get('size', 50);
        $icon = trim($this->params->get('icon', 'arrow'));
        $customSvg = trim($this->params->get('custom_svg', ''));
        $iconRotate = (int) $this->params->get('icon_rotate', 0);
        $transform = '';
        if ($iconRotate !== 0) {
            $transform .= 'rotate(' . $iconRotate . 'deg) ';
        }
        $transform .= 'translateY(-20%)';
        $trigger = $this->params->get('trigger', 'window');
        $fade = (int) $this->params->get('fade', 1);

        // Position in CSS umsetzen
        $cssPos = [];
        switch ($position) {
            case 'bottom-left':
                $cssPos[] = 'bottom: 30px; left: 30px; right: auto; top: auto;';
                break;
            case 'top-right':
                $cssPos[] = 'top: 30px; right: 30px; bottom: auto; left: auto;';
                break;
            case 'top-left':
                $cssPos[] = 'top: 30px; left: 30px; bottom: auto; right: auto;';
                break;
            default:
                $cssPos[] = 'bottom: 30px; right: 30px; left: auto; top: auto;';
        }

        // Fade/Show/Hide-Logik ins JS auslagern
        $jsShow = $fade
            ? "btn.style.display='block'; setTimeout(function(){btn.style.opacity=1;},10);"
            : "btn.style.display='block';";
        $jsHide = $fade
            ? "btn.style.opacity=0; setTimeout(function(){btn.style.display='none';},400);"
            : "btn.style.display='none';";

        // Icon-Ausgabe
        if ($customSvg !== '') {
            // Eigenes SVG direkt verwenden (ohne htmlspecialchars!)
            $iconHtml = '<span class="r3d-scroll2top-icon" style="display:inline-block;vertical-align:middle;line-height:1;' . $transform . '">' . $customSvg . '</span>';
        } elseif ($icon !== '' && $icon !== 'arrow') {
            // Eigenes Zeichen, Unicode, Emoji, Caret etc. – mit Rotation!
            $iconHtml = '<span class="r3d-scroll2top-icon" style="font-size:1.7em;display:inline-block;vertical-align:middle;line-height:1;' . $transform . '">' . htmlspecialchars($icon, ENT_QUOTES | ENT_HTML5, 'UTF-8') . '</span>';
        } else {
            // Fallback: Standardpfeil
            $iconHtml = '<span class="r3d-scroll2top-icon" style="font-size:1.7em;display:inline-block;vertical-align:middle;line-height:1;">&#8679;</span>';
        }

        // CSS, HTML, JS
        $buttonHtml = '
<style>
#r3d-scroll2top {
    position: fixed;
    ' . $cssPos[0] . '
    z-index: 9999;
    display: none;
    width: ' . $size . 'px;
    height: ' . $size . 'px;
    background: ' . $color . ';
    color: #fff;
    border-radius: 50%;
    text-align: center;
    line-height: ' . $size . 'px;
    font-size: 26px;
    cursor: pointer;
    box-shadow: 0 2px 8px rgba(0,0,0,0.14);
    ' . ($fade ? 'transition: opacity 0.4s; opacity: 0.85;' : '') . '
    border: none;
    user-select: none;
}
#r3d-scroll2top:focus, #r3d-scroll2top:hover {
    background: #444;
    opacity: 1 !important;
    outline: none;
}
@media (max-width: 600px) {
    #r3d-scroll2top {
        width: 38px;
        height: 38px;
        font-size: 20px;
        line-height: 38px;
    }
}
</style>
<div id="r3d-scroll2top" aria-label="Scroll to top" role="button" tabindex="0">'
            . $iconHtml .
            '</div>
<script>
(function() {
    var btn = document.getElementById("r3d-scroll2top");
    function toggleBtn() {
        var triggerVal = "' . addslashes($trigger) . '";
        var show = false;
        if (triggerVal === "window") {
            show = window.scrollY > window.innerHeight;
        } else if (!isNaN(parseInt(triggerVal))) {
            show = window.scrollY > parseInt(triggerVal);
        }
        if (show) {
            ' . $jsShow . '
        } else {
            ' . $jsHide . '
        }
    }
    window.addEventListener("scroll", toggleBtn);
    document.addEventListener("DOMContentLoaded", toggleBtn);

    btn.addEventListener("click", function() {
        window.scrollTo({ top: 0, behavior: "smooth" });
    });
    btn.addEventListener("keydown", function(e) {
        if (e.key === "Enter" || e.key === " ") {
            window.scrollTo({ top: 0, behavior: "smooth" });
        }
    });
})();
</script>
';

        // Direkt vor </body> einfügen
        $body = $app->getBody();
        $body = str_ireplace('</body>', $buttonHtml . '</body>', $body);
        $app->setBody($body);
    }
}
