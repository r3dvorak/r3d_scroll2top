<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  System.r3d_scroll2top
 * @creation    2025-08-29
 * @author      Richard Dvorak, r3d.de
 * @copyright   Copyright (C) 2025 Richard Dvorak, https://r3d.de
 * @license     GNU GPL v3 or later (https://www.gnu.org/licenses/gpl-3.0.html)
 * @version     5.3.5
 * @file        plugins/system/r3d_scroll2top/r3d_scroll2top.php
 */

declare(strict_types=1);

defined('_JEXEC') or die;

use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\CMS\Factory;

if (!function_exists('r3d_getRGBA')) {
    function r3d_getRGBA($color, $alpha, $fallback = '#000')
    {
        $color = trim((string) $color);
        $alpha = trim((string) $alpha);
        if ($color === '') {
            return $fallback;
        }
        if ($alpha === '' || $alpha === '1') {
            // Immer rgba, auch wenn alpha = 1:
            if (preg_match('/^#([0-9a-f]{3,8})$/i', $color, $m)) {
                $hex = ltrim($m[1], '#');
                if (strlen($hex) === 3) {
                    $hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
                }
                if (strlen($hex) === 6) {
                    $r = hexdec(substr($hex, 0, 2));
                    $g = hexdec(substr($hex, 2, 2));
                    $b = hexdec(substr($hex, 4, 2));
                    return "rgba($r,$g,$b,1)";
                }
            }
            return $color;
        }
        // HEX (#fff oder #ffffff) in rgb umwandeln
        if (preg_match('/^#([0-9a-f]{3,8})$/i', $color, $m)) {
            $hex = ltrim($m[1], '#');
            if (strlen($hex) === 3) {
                $hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
            }
            if (strlen($hex) === 6) {
                $r = hexdec(substr($hex, 0, 2));
                $g = hexdec(substr($hex, 2, 2));
                $b = hexdec(substr($hex, 4, 2));
                return "rgba($r,$g,$b,$alpha)";
            }
        }
        // Sonst als css-Farbe plus alpha: 'color' → 'color' (Browser ignoriert alpha)
        return $color;
    }
}

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
        $color = $this->params->get('color', '#ff00e6');
        $colorAlpha = $this->params->get('color_alpha', '0.7');
        $hoverColor = $this->params->get('hover_color', '#00e6ff');
        $hoverColorAlpha = $this->params->get('hover_color_alpha', '0.7');
        $iconColor = $this->params->get('icon_color', '#ffffff');
        $iconColorAlpha = $this->params->get('icon_color_alpha', '1');

        $btnColor = r3d_getRGBA($color, $colorAlpha, '#ff00e6');
        $btnHoverColor = r3d_getRGBA($hoverColor, $hoverColorAlpha, '#00e6ff');
        $iconColorCss = r3d_getRGBA($iconColor, $iconColorAlpha, '#ffffff');

        $position = $this->params->get('position', 'bottom-right');
        $size = (int) $this->params->get('size', 50);
        $iconInput = trim($this->params->get('icon', '⬆'));
        $iconImage = trim($this->params->get('icon_image', ''));
        $iconRotate = (int) $this->params->get('icon_rotate', 0);
        $iconTranslateY = (int) $this->params->get('icon_translate_y', -20);
        $trigger = $this->params->get('trigger', 'window');
        $fade = (int) $this->params->get('fade', 1);
        $iconJitter = (int) $this->params->get('icon_jitter', 1);
        $buttonShadow = (int) $this->params->get('button_shadow', 1);

        $boxShadow = $buttonShadow ? 'box-shadow: 0 2px 8px rgba(0,0,0,0.14);' : '';

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

        // Transformation fürs Icon (Rotation/Verschiebung als CSS-Variable)
        $transform = '';
        if ($iconRotate !== 0) {
            $transform .= 'rotate(' . $iconRotate . 'deg) ';
        }
        if ($iconTranslateY !== 0) {
            $transform .= 'translateY(' . $iconTranslateY . '%)';
        }
        $transformStyle = $transform !== '' ? '--r3d-icon-transform:' . $transform . ';' : '';
        $iconStyle = 'display:inline-block;vertical-align:middle;line-height:1;' . $transformStyle . 'color:' . $iconColorCss . ';';

        // Icon-Ausgabe: Alles immer in Wrapper-Span (für Zittern/Animation)
        $iconHtml = '<span class="r3d-scroll2top-icon" style="' . $iconStyle . '">';
        if ($iconImage !== '') {
            $iconHtml .= '<img src="' . htmlspecialchars($iconImage, ENT_QUOTES | ENT_HTML5, 'UTF-8') . '" alt="Top" style="max-width:60%;max-height:60%;border:none;box-shadow:none;" />';
        } elseif ($iconInput !== '') {
            if (stripos($iconInput, '<svg') !== false) {
                $iconHtml .= $iconInput;
            } else {
                $iconHtml .= htmlspecialchars($iconInput, ENT_QUOTES | ENT_HTML5, 'UTF-8');
            }
        } else {
            $iconHtml .= '&#8679;';
        }
        $iconHtml .= '</span>';

        // Jitter-Animation CSS
        $jitterCss = '';
        if ($iconJitter) {
            $jitterCss = '
#r3d-scroll2top:focus .r3d-scroll2top-icon,
#r3d-scroll2top:hover .r3d-scroll2top-icon {
    animation: r3d-shake 0.6s linear 1;
}
@keyframes r3d-shake {
    0%   { transform: var(--r3d-icon-transform, none) translateX(0); }
    10%  { transform: var(--r3d-icon-transform, none) translateX(-2px); }
    20%  { transform: var(--r3d-icon-transform, none) translateX(2px); }
    30%  { transform: var(--r3d-icon-transform, none) translateX(-2px); }
    40%  { transform: var(--r3d-icon-transform, none) translateX(2px); }
    50%  { transform: var(--r3d-icon-transform, none) translateX(-1px); }
    60%  { transform: var(--r3d-icon-transform, none) translateX(1px); }
    70%  { transform: var(--r3d-icon-transform, none) translateX(-1px); }
    80%  { transform: var(--r3d-icon-transform, none) translateX(1px); }
    90%  { transform: var(--r3d-icon-transform, none) translateX(-1px); }
    100% { transform: var(--r3d-icon-transform, none) translateX(0); }
}
';
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
    background: ' . $btnColor . ';
    color: #fff;
    border-radius: 50%;
    text-align: center;
    line-height: ' . $size . 'px;
    font-size: 26px;
    cursor: pointer;
    ' . $boxShadow . '
    ' . ($fade ? 'transition: opacity 0.4s; opacity: 0.85;' : '') . '
    border: none;
    user-select: none;
}
#r3d-scroll2top:focus, #r3d-scroll2top:hover {
    background: ' . $btnHoverColor . ';
    opacity: 1 !important;
    outline: none;
}
.r3d-scroll2top-icon {
    transform: var(--r3d-icon-transform, none);
    will-change: transform;
}
' . $jitterCss . '
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
    var isVisible = false;
    function toggleBtn() {
        var triggerVal = "' . addslashes($trigger) . '";
        var show = false;
        if (triggerVal === "window") {
            show = window.scrollY >= window.innerHeight;
        } else if (!isNaN(parseInt(triggerVal))) {
            show = window.scrollY >= parseInt(triggerVal);
        }
        if (show && !isVisible) {
            ' . $jsShow . '
            isVisible = true;
        } else if (!show && isVisible) {
            ' . $jsHide . '
            isVisible = false;
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
