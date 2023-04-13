<?php

/**
 * @package     selectwizard
 * @since       13.04.2023 - 16:50
 * @author      Patrick Froch <info@easySolutionsIT.de>
 * @see         http://easySolutionsIT.de
 * @copyright   e@sy Solutions IT 2023
 * @license     EULA
 */

declare(strict_types=1);

namespace Esit\Selectwizard\Classes\Services;

use Contao\SelectMenu;

class WidgetFactory
{
    /**
     * Erstellt das Widget für ein Auswahlfeld.
     * @return SelectMenu
     */
    public function createSelectMenu(): SelectMenu
    {
        return new SelectMenu();
    }
}