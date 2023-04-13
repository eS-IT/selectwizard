<?php
/**
 * @package     selectwizard
 * @since       16.02.20 - 13:16
 * @author      Patrick Froch <info@easySolutionsIT.de>
 * @link        http://easySolutionsIT.de
 * @copyright   e@sy Solutions IT 2020
 * @license     LGPL-3.0-only
 */

declare(strict_types=1);

namespace Esit\Selectwizard\Tests\Listener;

use Contao\BackendTemplate;
use Esit\Selectwizard\Classes\Events\OnGenerateWidgetEvent;
use Esit\Selectwizard\Classes\Listener\OnGenerateWidgetListener;
use Esit\Selectwizard\Classes\Services\AssetHandler;
use Esit\Selectwizard\Classes\Services\SelectHandler;
use Esit\Selectwizard\EsitTestCase;

class OnGenerateWidgetListenerTest extends EsitTestCase
{


    public function testInsertCssDoNothingIfCssArrayIsEmpty(): void
    {
        $ah         = $this->getMockBuilder(AssetHandler::class)->onlyMethods(['insertAsset'])->getMock();
        $sh         = $this->getMockBuilder(SelectHandler::class)->onlyMethods(['createSelect'])->getMock();
        $ah->expects($this->never())->method('insertAsset');
        $listener   = new OnGenerateWidgetListener($ah, $sh);
        $event      = new OnGenerateWidgetEvent();
        $listener->insertCss($event);
    }


    public function testInsertCssCallsInsertAssetIfCssArrayIsSet(): void
    {
        $css        = ['/tmp/css/one', '/tmp/css/two', '/tmp/css/three'];
        $ah         = $this->getMockBuilder(AssetHandler::class)->onlyMethods(['insertAsset'])->getMock();
        $sh         = $this->getMockBuilder(SelectHandler::class)->onlyMethods(['createSelect'])->getMock();
        $ah->expects($this->exactly(\count($css)))->method('insertAsset');
        $listener   = new OnGenerateWidgetListener($ah, $sh);
        $event      = new OnGenerateWidgetEvent();
        $event->setTlCss($css);
        $listener->insertCss($event);
    }


    public function testInsertJsDoNothingInJsArrayIsEmpty(): void
    {
        $ah         = $this->getMockBuilder(AssetHandler::class)->onlyMethods(['insertAsset'])->getMock();
        $sh         = $this->getMockBuilder(SelectHandler::class)->onlyMethods(['createSelect'])->getMock();
        $ah->expects($this->never())->method('insertAsset');
        $listener   = new OnGenerateWidgetListener($ah, $sh);
        $event      = new OnGenerateWidgetEvent();
        $listener->insertJs($event);
    }


    public function testInsertJsCallsInserTAssetsIfJsArrayIsSet(): void
    {
        $js        = ['/tmp/js/one', '/tmp/js/two', '/tmp/js/three'];
        $ah         = $this->getMockBuilder(AssetHandler::class)->onlyMethods(['insertAsset'])->getMock();
        $sh         = $this->getMockBuilder(SelectHandler::class)->onlyMethods(['createSelect'])->getMock();
        $ah->expects($this->exactly(\count($js)))->method('insertAsset');
        $listener   = new OnGenerateWidgetListener($ah, $sh);
        $event      = new OnGenerateWidgetEvent();
        $event->setTlJavascript($js);
        $listener->insertJs($event);
    }


    public function testGenerateWidgetsCallsCreateSelectWithoutValueIfValuesAreEmpty(): void
    {
        $ah         = $this->getMockBuilder(AssetHandler::class)->onlyMethods(['insertAsset'])->getMock();
        $sh         = $this->getMockBuilder(SelectHandler::class)->onlyMethods(['createSelect'])->getMock();
        $sh->expects($this->once())->method('createSelect')->with('test', ['test']);
        $listener   = new OnGenerateWidgetListener($ah, $sh);
        $event      = new OnGenerateWidgetEvent();
        $event->setFieldId('test');
        $event->setConfiguration(['test']);
        $listener->generateWidgets($event);
    }


    public function testGenerateWidgetsCallsCreateSelectIfValuesAreSet(): void
    {
        $values     = ['one', 'two'];
        $ah         = $this->getMockBuilder(AssetHandler::class)->onlyMethods(['insertAsset'])->getMock();
        $sh         = $this->getMockBuilder(SelectHandler::class)->onlyMethods(['createSelect'])->getMock();
        $sh->expects($this->exactly(\count($values)))->method('createSelect');
        $listener   = new OnGenerateWidgetListener($ah, $sh);
        $event      = new OnGenerateWidgetEvent();
        $event->setValues($values);
        $listener->generateWidgets($event);
    }


    public function testCreateTemplateDoNothingIfTemplateNameIsNotGiven(): void
    {
        $ah         = $this->getMockBuilder(AssetHandler::class)->onlyMethods(['insertAsset'])->getMock();
        $sh         = $this->getMockBuilder(SelectHandler::class)->onlyMethods(['createSelect'])->getMock();
        $listener   = new OnGenerateWidgetListener($ah, $sh);
        $event      = new OnGenerateWidgetEvent();
        $listener->createTemplate($event);
        $rtn        = $event->getTemplate();
        $this->assertEmpty($rtn);
    }


    public function testCreateTemplateIfTemplateNameIsGiven(): void
    {
        $ah         = $this->getMockBuilder(AssetHandler::class)->onlyMethods(['insertAsset'])->getMock();
        $sh         = $this->getMockBuilder(SelectHandler::class)->onlyMethods(['createSelect'])->getMock();
        $listener   = new OnGenerateWidgetListener($ah, $sh);
        $event      = new OnGenerateWidgetEvent();
        $event->setTemplateName('test');
        $listener->createTemplate($event);
        $rtn        = $event->getTemplate();
        $this->assertInstanceOf(BackendTemplate::class, $rtn);
    }


    public function testAddDataToTemplateaDoNothingIfTmeplateIsNull(): void
    {
        $ah         = $this->getMockBuilder(AssetHandler::class)->onlyMethods(['insertAsset'])->getMock();
        $sh         = $this->getMockBuilder(SelectHandler::class)->onlyMethods(['createSelect'])->getMock();
        $listener   = new OnGenerateWidgetListener($ah, $sh);
        $event      = new OnGenerateWidgetEvent();
        $listener->addDataToTemplate($event);
        $template   = $event->getTemplate();
        $this->assertEmpty($template);
    }


    public function testAddDataToTemplateaSetData(): void
    {
        $ah         = $this->getMockBuilder(AssetHandler::class)->onlyMethods(['insertAsset'])->getMock();
        $sh         = $this->getMockBuilder(SelectHandler::class)->onlyMethods(['createSelect'])->getMock();
        $listener   = new OnGenerateWidgetListener($ah, $sh);
        $event      = new OnGenerateWidgetEvent();
        $template   = new BackendTemplate('test_dummy');
        $event->setTemplate($template);
        $event->setFieldId('ctrl_testfield');
        $event->setLabel('testfield');
        $event->setMscLang(['Language']);
        $listener->addDataToTemplate($event);
        $template = $event->getTemplate();
        $this->assertSame('testfield_list', $template->strId);
        $this->assertSame('testfield', $template->label);
        $this->assertSame(['Language'], $template->lang);
    }


    public function testParseOutputDoNothingIfTemplateIsNull(): void
    {
        $ah         = $this->getMockBuilder(AssetHandler::class)->onlyMethods(['insertAsset'])->getMock();
        $sh         = $this->getMockBuilder(SelectHandler::class)->onlyMethods(['createSelect'])->getMock();

        $listener   = new OnGenerateWidgetListener($ah, $sh);
        $event      = new OnGenerateWidgetEvent();
        $listener->parseOutput($event);
        $output    = $event->getOutput();
        $this->assertEmpty($output);
    }


    public function testParseOutputGeneratesOutput(): void
    {
        $ah         = $this->getMockBuilder(AssetHandler::class)->onlyMethods(['insertAsset'])->getMock();
        $sh         = $this->getMockBuilder(SelectHandler::class)->onlyMethods(['createSelect'])->getMock();
        $template   = $this->getMockBuilder(BackendTemplate::class)->onlyMethods(['parse'])->getMock();

        $template->expects($this->once())->method('parse')->willReturn('output');

        $listener   = new OnGenerateWidgetListener($ah, $sh);
        $event      = new OnGenerateWidgetEvent();

        $event->setTemplate($template);
        $listener->parseOutput($event);
        $this->assertSame('output', $event->getOutput());
    }
}
