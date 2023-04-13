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

use Contao\SelectMenu;
use Esit\Selectwizard\Classes\Services\SelectHandler;
use Esit\Selectwizard\Classes\Services\WidgetFactory;
use Esit\Selectwizard\EsitTestCase;

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
        $select         = $this->mockClassWithProperties(SelectMenu::class);
        $factory        = $this->getMockBuilder(WidgetFactory::class)->disableOriginalConstructor()->getMock();
        $selectHandler  = new SelectHandler($factory);
        $factory->expects(self::once())->method('createSelectMenu')->willReturn($select);
        $select->expects(self::exactly(3))->method('__set');
        // todo Einzelne Werte Prüfen, withConsecutive() ist deprecated!

        $rtn            = $selectHandler->createSelect($cssId, $config, $value);

        $this->assertSame($select, $rtn);
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
        $select         = $this->mockClassWithProperties(SelectMenu::class);
        $factory        = $this->getMockBuilder(WidgetFactory::class)->disableOriginalConstructor()->getMock();
        $selectHandler  = new SelectHandler($factory);
        $factory->expects(self::once())->method('createSelectMenu')->willReturn($select);
        $select->expects(self::exactly(4))->method('__set');
        // todo Einzelne Werte Prüfen, withConsecutive() ist deprecated!

        $rtn            = $selectHandler->createSelect($cssId, $config, $value);

        $this->assertSame($select, $rtn);
    }
}
