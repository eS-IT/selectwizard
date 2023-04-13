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
use Esit\Selectwizard\Classes\Services\TemplateFactory;
use Esit\Selectwizard\EsitTestCase;
use PHPUnit\Framework\MockObject\MockObject;

class OnGenerateWidgetListenerTest extends EsitTestCase
{

    /**
     * @var (AssetHandler&MockObject)|MockObject
     */
    private $assetHandler;


    /**
     * @var (SelectHandler&MockObject)|MockObject
     */
    private $selectHandler;


    /**
     * @var (SelectHandler&MockObject)|MockObject
     */
    private $templateFactory;


    /**
     * @var OnGenerateWidgetEvent
     */
    private $event;


    /**
     * @var OnGenerateWidgetListener
     */
    private $listener;


    protected function setUp(): void
    {
        $this->assetHandler     = $this->getMockBuilder(AssetHandler::class)->onlyMethods(['insertAsset'])->getMock();

        $this->selectHandler    = $this->getMockBuilder(SelectHandler::class)->onlyMethods(['createSelect'])->getMock();

        $this->templateFactory  = $this->getMockBuilder(TemplateFactory::class)->getMock();

        $this->event            = new OnGenerateWidgetEvent();

        $this->listener         = new OnGenerateWidgetListener(
            $this->assetHandler,
            $this->selectHandler,
            $this->templateFactory
        );
    }

    public function testInsertCssDoNothingIfCssArrayIsEmpty(): void
    {
        $this->assetHandler->expects($this->never())->method('insertAsset');
        $this->listener->insertCss($this->event);
    }


    public function testInsertCssCallsInsertAssetIfCssArrayIsSet(): void
    {
        $css = ['/tmp/css/one', '/tmp/css/two', '/tmp/css/three'];
        $this->assetHandler->expects($this->exactly(\count($css)))->method('insertAsset');
        $this->event->setTlCss($css);
        $this->listener->insertCss($this->event);
    }


    public function testInsertJsDoNothingInJsArrayIsEmpty(): void
    {
        $this->assetHandler->expects($this->never())->method('insertAsset');
        $this->listener->insertJs($this->event);
    }


    public function testInsertJsCallsInserTAssetsIfJsArrayIsSet(): void
    {
        $js = ['/tmp/js/one', '/tmp/js/two', '/tmp/js/three'];
        $this->assetHandler->expects($this->exactly(\count($js)))->method('insertAsset');
        $this->event->setTlJavascript($js);
        $this->listener->insertJs($this->event);
    }


    public function testGenerateWidgetsCallsCreateSelectWithoutValueIfValuesAreEmpty(): void
    {
        $this->selectHandler->expects($this->once())->method('createSelect')->with('test', ['test']);
        $this->event->setFieldId('test');
        $this->event->setConfiguration(['test']);
        $this->listener->generateWidgets($this->event);
    }


    public function testGenerateWidgetsCallsCreateSelectIfValuesAreSet(): void
    {
        $values = ['one', 'two'];
        $this->selectHandler->expects($this->exactly(\count($values)))->method('createSelect');
        $this->event->setValues($values);
        $this->listener->generateWidgets($this->event);
    }


    public function testCreateTemplateDoNothingIfTemplateNameIsNotGiven(): void
    {
        $this->templateFactory->expects(self::never())->method('createBackendTemplate');
        $this->listener->createTemplate($this->event);
        self::assertEmpty($this->event->getTemplate());
    }


    public function testCreateTemplateIfTemplateNameIsGiven(): void
    {
        $name       = 'test';
        $template   = $this->getMockBuilder(BackendTemplate::class)->disableOriginalConstructor()->getMock();

        $this->templateFactory
            ->expects(self::once())
            ->method('createBackendTemplate')
            ->with($name)
            ->willReturn($template);

        $this->event->setTemplateName($name);
        $this->listener->createTemplate($this->event);
        self::assertSame($template, $this->event->getTemplate());
    }


    public function testAddDataToTemplateaDoNothingIfTmeplateIsNull(): void
    {
        $this->listener->addDataToTemplate($this->event);
        $template = $this->event->getTemplate();
        self::assertEmpty($template);
    }


    public function testAddDataToTemplateaSetData(): void
    {
        $template   = $this->getMockBuilder(BackendTemplate::class)->disableOriginalConstructor()->getMock();

        $this->event->setTemplate($template);
        $this->event->setFieldId('ctrl_testfield');
        $this->event->setLabel('testfield');
        $this->event->setMscLang(['Language']);
        $this->event->setConfiguration(['config']);

        $matcher = self::exactly(4);
        $template->expects(self::once())->method('setData')->with(['config']);
        $template->expects($matcher)->method('__set');
        // todo Einzelne Werte Prüfen, withConsecutive() ist deprecated!

        $this->listener->addDataToTemplate($this->event);
    }


    public function testParseOutputDoNothingIfTemplateIsNull(): void
    {
        $this->listener->parseOutput($this->event);
        self::assertEmpty($this->event->getOutput());
    }


    public function testParseOutputGeneratesOutput(): void
    {
        $template = $this->getMockBuilder(BackendTemplate::class)->onlyMethods(['parse'])->getMock();
        $template->expects($this->once())->method('parse')->willReturn('output');

        $this->event->setTemplate($template);
        $this->listener->parseOutput($this->event);
        self::assertSame('output', $this->event->getOutput());
    }
}
