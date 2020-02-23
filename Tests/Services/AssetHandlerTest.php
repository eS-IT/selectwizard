<?php declare(strict_types=1);
/**
 * @package     selectwizard
 * @filesource  AssetHandlerTest.php
 * @version     1.0.0
 * @since       16.02.20 - 11:44
 * @author      Patrick Froch <info@easySolutionsIT.de>
 * @link        http://easySolutionsIT.de
 * @copyright   e@sy Solutions IT 2020
 * @license     EULA
 */
namespace Esit\Selectwizard\Tests\Services;

use Esit\Selectwizard\Classes\Services\AssetHandler;
use Esit\Selectwizard\EsitTestCase;

/**
 * Class AssetHandlerTest
 * @package Esit\Selectwizard\Tests\Services
 */
class AssetHandlerTest extends EsitTestCase
{


    public function testInsertAssetDoNothingIfTypeIsEmpty(): void
    {
        $type           = '';
        $path           = '/tmp';
        $assetHandler   = new AssetHandler();
        unset($GLOBALS[$type]);
        $assetHandler->insertAsset($path, $type);
        $this->assertEmpty($GLOBALS[$type]);
    }

    public function testInsertAssetDoNothingIfPathIsEmpty(): void
    {
        $type           = 'TL_CSS';
        $path           = '';
        $assetHandler   = new AssetHandler();
        unset($GLOBALS[$type]);
        $assetHandler->insertAsset($path, $type);
        $this->assertEmpty($GLOBALS[$type]);
    }

    public function testInsertAssetDoNothingIfPathIsAlreadySet(): void
    {
        $type               = 'TL_CSS';
        $path               = '/tmp';
        $assetHandler       = new AssetHandler();
        $GLOBALS[$type][]   = $path;
        $assetHandler->insertAsset($path, $type);
        $this->assertEquals(1, \count($GLOBALS[$type]));
    }

    public function testInsertAssetSetPathIfPathAndTypeAreSet(): void
    {
        $type               = 'TL_CSS';
        $path               = '/tmp';
        $assetHandler       = new AssetHandler();
        unset($GLOBALS[$type]);
        $assetHandler->insertAsset($path, $type);
        $this->assertEquals($GLOBALS[$type][0], $path);
    }
}
