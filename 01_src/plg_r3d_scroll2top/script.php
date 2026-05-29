<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  System.r3d_scroll2top
 */

declare(strict_types=1);

defined('_JEXEC') or die;

use Joomla\CMS\Installer\InstallerScript;
use Joomla\CMS\Filesystem\File;

/**
 * Installer script for explicit platform constraints.
 */
final class PlgSystemR3d_Scroll2topInstallerScript extends InstallerScript
{
    /**
     * Minimum supported PHP version.
     *
     * @var string
     */
    protected $minimumPhp = '8.1.0';

    /**
     * Minimum supported Joomla version.
     *
     * @var string
     */
    protected $minimumJoomla = '4.4.0';

    /**
     * Cleanup known legacy language targets on uninstall.
     *
     * @param   object  $adapter  Installer adapter (unused).
     *
     * @return  bool
     */
    public function uninstall($adapter): bool
    {
        $targets = [
            JPATH_SITE . '/language/en-GB/en-GB.plg_system_r3d_scroll2top.ini',
            JPATH_SITE . '/language/de-DE/de-DE.plg_system_r3d_scroll2top.ini',
            JPATH_ADMINISTRATOR . '/language/en-GB/en-GB.plg_system_r3d_scroll2top.sys.ini',
            JPATH_ADMINISTRATOR . '/language/de-DE/de-DE.plg_system_r3d_scroll2top.sys.ini',
        ];

        foreach ($targets as $target) {
            if (is_file($target)) {
                File::delete($target);
            }
        }

        return true;
    }
}
