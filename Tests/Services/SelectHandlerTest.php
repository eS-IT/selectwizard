<?php

/**
 * @package     selectwizard
 * @since       16.02.20 - 12:43
 * @author      Patrick Froch <info@easySolutionsIT.de>
 * @link        http://easySolutionsIT.de
 * @copyright   e@sy Solutions IT 2020
 * @license     LGPL-3.0-only
 */

declare(strict_types=1);

namespace Esit\Selectwizard\Tests\Services;

use Esit\Selectwizard\Classes\Services\SelectHandler;
use PHPUnit\Framework\TestCase;

class SelectHandlerTest extends TestCase
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
