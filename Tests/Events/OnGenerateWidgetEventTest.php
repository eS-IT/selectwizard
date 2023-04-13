<?php

/**
 * @package     selectwizard
 * @since       16.02.20 - 18:42
 * @author      Patrick Froch <info@easySolutionsIT.de>
 * @link        http://easySolutionsIT.de
 * @copyright   e@sy Solutions IT 2020
 * @license     LGPL-3.0-only
 */

declare(strict_types=1);

namespace Esit\Selectwizard\Tests\Events;

use Esit\Selectwizard\Classes\Events\OnGenerateWidgetEvent;
use Esit\Selectwizard\EsitTestCase;

class OnGenerateWidgetEventTest extends EsitTestCase
{


    public function testSetConfiguration(): void
    {
        $event = new OnGenerateWidgetEvent();
        $event->setConfiguration(['config']);
        $this->assertSame(['config'], $event->getConfiguration());
    }
}
