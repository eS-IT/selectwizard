<?php declare(strict_types = 1);
/**
 * @package     selectwizard
 * @filesource  SelectHandler.php
 * @version     1.0.0
 * @since       15.02.20 - 21:40
 * @author      Patrick Froch <info@easySolutionsIT.de>
 * @see         http://easySolutionsIT.de
 * @copyright   e@sy Solutions IT 2020
 * @license     LGPLv3
 */
namespace Esit\Selectwizard\Classes\Services;

use Contao\SelectMenu;

/**
 * Class SelectHandler
 * @package Esit\Selectwizard\Classes\Services
 */
class SelectHandler
{


    /**
     * Erzeugt die einzelnen Auswahlfelder.
     * @param  string     $cssId
     * @param  array      $config
     * @param  null       $value
     * @return SelectMenu
     */
    public function createSelect(string $cssId, array $config, $value = null): SelectMenu
    {
        $select         = new SelectMenu();
        $select->addAttributes($config);
        $select->name   = $cssId . '[]';
        $select->id     = $cssId;
        $select->class  = 'selectmenuwizard';

        if (!empty($value)) {
            $select->value = $value;
        }

        return $select;
    }
}
