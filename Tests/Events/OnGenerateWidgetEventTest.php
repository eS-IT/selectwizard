<?php declare(strict_types=1);
/**
 * @package     selectwizard
 * @filesource  OnGenerateWidgetEventTest.php
 * @version     1.0.0
 * @since       16.02.20 - 18:42
 * @author      Patrick Froch <info@easySolutionsIT.de>
 * @link        http://easySolutionsIT.de
 * @copyright   e@sy Solutions IT 2020
 * @license     EULA
 */
namespace Esit\Selectwizard\Tests\Events;

use Esit\Selectwizard\Classes\Events\OnGenerateWidgetEvent;
use Esit\Selectwizard\EsitTestCase;

/**
 * Class OnGenerateWidgetEventTest
 * @package Esit\Selectwizard\Tests\Events
 */
class OnGenerateWidgetEventTest extends EsitTestCase
{


    public function testSetConfiguration(): void
    {
        $event = new OnGenerateWidgetEvent();
        $event->setConfiguration(['config']);
        $this->assertSame(['config'], $event->getConfiguration());
    }
}
