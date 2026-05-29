<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  System.r3d_scroll2top
 */

declare(strict_types=1);

defined('_JEXEC') or die;

use Joomla\CMS\Installer\InstallerScript;

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
}

