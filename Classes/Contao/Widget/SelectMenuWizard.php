<?php declare(strict_types = 1);
/**
 * @package     selectwizard
 * @filesource  SelectMenuWizard.php
 * @version     1.0.0
 * @since       14.02.20 - 16:34
 * @author      Patrick Froch <info@easySolutionsIT.de>
 * @see        http://easySolutionsIT.de
 * @copyright   e@sy Solutions IT 2020
 * @license     LGPLv3
 */
namespace Esit\Selectwizard\Classes\Contao\Widget;

use Contao\System;
use Contao\Widget;
use Esit\Selectwizard\Classes\Events\OnGenerateWidgetEvent;

/**
 * Class SelectMenuWizard
 * @package Esit\Selectwizard\Classes\Contao\Widget
 */
class SelectMenuWizard extends Widget
{

    /**
     * Submit user input
     * @var bool
     */
    protected $blnSubmitInput = true;


    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'be_widget';


    /**
     * Name des Ausgabetemplates
     * @var string
     */
    protected $widgetTemplate = 'be_select_menu_wizard';


    /**
     * @return string
     */
    public function generate()
    {
        $di     = System::getContainer()->get('event_dispatcher');
        $event  = new OnGenerateWidgetEvent();

        $event->setConfiguration((array)$this->arrConfiguration);
        $event->setFieldId((string)$this->strId);
        $event->setLabel((string)$this->strLabel);
        $event->setValues((array)$this->varValue);
        $event->setTemplateName($this->widgetTemplate);
        $event->setTlCss(['bundles/esitselectwizard/css/selectlistfix.css']);
        $event->setTlJavascript(['bundles/esitselectwizard/js/ListInitializer.js']);

        if (\is_array($GLOBALS['TL_LANG']['MSC'])) {
            $event->setMscLang($GLOBALS['TL_LANG']['MSC']);
        }

        if (null !== $di) {
            $di->dispatch($event::NAME, $event);
        }

        return $event->getOutput();
    }
}
