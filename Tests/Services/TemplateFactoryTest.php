<?php

/**
 * @package     selectwizard
 * @since       13.04.2023 - 16:43
 * @author      Patrick Froch <info@easySolutionsIT.de>
 * @see         http://easySolutionsIT.de
 * @copyright   e@sy Solutions IT 2023
 * @license     EULA
 */

declare(strict_types=1);

namespace Esit\Selectwizard\Tests\Services;

use Esit\Selectwizard\Classes\Services\TemplateFactory;
use PHPUnit\Framework\TestCase;

class TemplateFactoryTest extends TestCase
{

    public function testCreateBackendTemplate(): void
    {
        $factory = new TemplateFactory();

        self::assertNotNull($factory->createBackendTemplate('fe_page'));
    }
}
