<?php declare(strict_types = 1);
/**
 * @package     selectwizard
 * @filesource  AssetHandler.php
 * @version     1.0.0
 * @since       15.02.20 - 21:32
 * @author      Patrick Froch <info@easySolutionsIT.de>
 * @see         http://easySolutionsIT.de
 * @copyright   e@sy Solutions IT 2020
 * @license     LGPLv3
 */
namespace Esit\Selectwizard\Classes\Services;

/**
 * Class AssetHandler
 * @package Esit\Selectwizard\Classes\Helper
 */
class AssetHandler
{


    /**
     * Fügt den $GLOBLAS von Contao die Assets (CSS|JS) hinzu.
     * @param string $path
     * @param string $type
     */
    public function insertAsset(string $path, string $type): void
    {
        if (!empty($path) &&
            !empty($type) &&
            (
                !\is_array($GLOBALS[$type]) ||
                !\in_array($path, $GLOBALS[$type], true)
            )
        ) {
            $GLOBALS[$type][] = $path;
        }
    }
}
