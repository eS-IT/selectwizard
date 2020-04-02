<?php declare(strict_types=1);
/**
 * @package     selectwizard
 * @filesource  SelectHandlerTest.php
 * @version     1.0.0
 * @since       16.02.20 - 12:43
 * @author      Patrick Froch <info@easySolutionsIT.de>
 * @link        http://easySolutionsIT.de
 * @copyright   e@sy Solutions IT 2020
 * @license     EULA
 */
namespace Esit\Selectwizard\Tests\Services;

use Esit\Selectwizard\Classes\Services\SelectHandler;
use Esit\Selectwizard\EsitTestCase;

/**
 * Class SelectHandlerTest
 * @package Esit\Selectwizard\Tests\Services
 */
class SelectHandlerTest extends EsitTestCase
{


    public function testCreateSelectGeneratesASelectMenu(): void
    {
        $config = [
            'options' => [
                ['value'=>'test01','label'=>'Test 01'],
                ['value'=>'test02', 'label'=>'Test 02']
            ]
        ];
        $cssId          = 'TestID';
        $value          = null;
        $expected       = '<select name="TestID[]" id="ctrl_TestID" class="tl_select selectmenuwizard" ';
        $expected      .= 'onfocus="Backend.getScrollOffset()">';
        $expected      .= '<option value="test01">Test 01</option>';
        $expected      .= '<option value="test02">Test 02</option>';
        $expected      .= '</select>';
        $selectHandler  = new SelectHandler();
        $rtn            = $selectHandler->createSelect($cssId, $config, $value);

        $this->assertSame($expected, $rtn->generateWithError());
    }

    public function testCreateSelectGeneratesASelectMenuAndSetTheValue(): void
    {
        $config = [
            'options' => [
                ['value'=>'test01','label'=>'Test 01'],
                ['value'=>'test02', 'label'=>'Test 02']
            ]
        ];
        $cssId          = 'TestID';
        $value          = 'test01';
        $expected       = '<select name="TestID[]" id="ctrl_TestID" class="tl_select selectmenuwizard" ';
        $expected      .= 'onfocus="Backend.getScrollOffset()">';
        $expected      .= '<option value="test01" selected>Test 01</option>';
        $expected      .= '<option value="test02">Test 02</option>';
        $expected      .= '</select>';
        $selectHandler  = new SelectHandler();
        $rtn            = $selectHandler->createSelect($cssId, $config, $value);

        $this->assertSame($expected, $rtn->generateWithError());
    }
}
