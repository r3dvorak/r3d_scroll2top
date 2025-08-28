<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  System.r3d_scroll2top
 * @creation    2025-08-28
 * @author      Richard Dvorak, r3d.de
 * @copyright   Copyright (C) 2025 Richard Dvorak, https://r3d.de
 * @license     GNU GPL v3 or later (https://www.gnu.org/licenses/gpl-3.0.html)
 * @version     5.0.0
 * @file        plugins/system/r3d_scroll2top/r3d_scroll2top.php
 *
 * Minimal Scroll To Top Button for Joomla 5 (PHP 8.4+ compatible)
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

        // Only in site application
        if ($app->isClient('administrator')) {
            return;
        }

        $body = $app->getBody();

        $buttonHtml = <<<'HTML'
<style>
#r3d-scroll2top {
    position: fixed;
    bottom: 30px;
    right: 30px;
    z-index: 9999;
    display: none;
    width: 50px;
    height: 50px;
    background: #222;
    color: #fff;
    border-radius: 50%;
    text-align: center;
    line-height: 50px;
    font-size: 24px;
    cursor: pointer;
    transition: background 0.2s;
}
#r3d-scroll2top:hover { background: #444; }
</style>
<div id="r3d-scroll2top" aria-label="Scroll to top" role="button" tabindex="0">&#8679;</div>
<script>
(function() {
    var btn = document.getElementById('r3d-scroll2top');
    window.addEventListener('scroll', function() {
        btn.style.display = (window.scrollY > 150) ? 'block' : 'none';
    });
    btn.addEventListener('click', function() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
    btn.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' || e.key === ' ') {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    });
})();
</script>
HTML;

        // Insert before </body>
        $body = str_ireplace('</body>', $buttonHtml . '</body>', $body);

        $app->setBody($body);
    }
}
