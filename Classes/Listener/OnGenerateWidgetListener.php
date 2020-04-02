<?php declare(strict_types = 1);
/**
 * @package     selectwizard
 * @filesource  OnGenerateWidgetListener.php
 * @version     1.0.0
 * @since       16.02.20 - 10:08
 * @author      Patrick Froch <info@easySolutionsIT.de>
 * @see         http://easySolutionsIT.de
 * @copyright   e@sy Solutions IT 2020
 * @license     LGPLv3
 */
namespace Esit\Selectwizard\Classes\Listener;

use Contao\BackendTemplate;
use Esit\Selectwizard\Classes\Events\OnGenerateWidgetEvent;
use Esit\Selectwizard\Classes\Services\AssetHandler;
use Esit\Selectwizard\Classes\Services\SelectHandler;

/**
 * Class OnGenerateWidgetListener
 * @package Esit\Selectwizard\Classes\Listener
 */
class OnGenerateWidgetListener
{


    /**
     * @var AssetHandler
     */
    protected $assetHandler;


    /**
     * @var SelectHandler
     */
    protected $selectHandler;


    /**
     * OnGenerateWidgetListener constructor.
     * @param AssetHandler  $assetHandler
     * @param SelectHandler $selectHandler
     */
    public function __construct(AssetHandler $assetHandler, SelectHandler $selectHandler)
    {
        $this->assetHandler     = $assetHandler;
        $this->selectHandler    = $selectHandler;
    }


    /**
     * Fügt die Assets ein.
     * @param OnGenerateWidgetEvent $event
     */
    public function insertCss(OnGenerateWidgetEvent $event): void
    {
        $css = $event->getTlCss();

        foreach ($css as $path) {
            $this->assetHandler->insertAsset($path, 'TL_CSS');
        }
    }


    /**
     * Fügt die Assets ein.
     * @param OnGenerateWidgetEvent $event
     */
    public function insertJs(OnGenerateWidgetEvent $event): void
    {
        $js = $event->getTlJavascript();

        foreach ($js as $path) {
            $this->assetHandler->insertAsset($path, 'TL_JAVASCRIPT');
        }
    }


    /**
     * Erstellt das Initiale Widget, wenn noch keine Werte vorhanden sind.
     * @param OnGenerateWidgetEvent $event
     */
    public function generateWidgets(OnGenerateWidgetEvent $event): void
    {
        $selects    = $event->getSelects();
        $id         = $event->getFieldId();
        $config     = $event->getConfiguration();
        $values     = $event->getValues();

        if (!empty($values)) {
            foreach ($values as $value) {
                $selects[] = $this->selectHandler->createSelect($id, $config, $value);
            }
        } else {
            $selects[] = $this->selectHandler->createSelect($id, $config);
        }

        $event->setSelects($selects);
    }


    /**
     * Erstellt eine Instanz des Ausgabetemplates.
     * @param OnGenerateWidgetEvent $event
     */
    public function createTemplate(OnGenerateWidgetEvent $event): void
    {
        $name = $event->getTemplateName();

        if (!empty($name)) {
            $template = new BackendTemplate($name);
            $event->setTemplate($template);
        }
    }


    /**
     * Fügt dem Template die Daten hinzu.
     * @param OnGenerateWidgetEvent $event
     */
    public function addDataToTemplate(OnGenerateWidgetEvent $event): void
    {
        $template = $event->getTemplate();

        if (null !== $template) {
            $template->setData($event->getConfiguration());
            $template->strId       = \str_replace('ctrl_', '', $event->getFieldId()) . '_list';
            $template->label       = $event->getLabel();
            $template->lang        = $event->getMscLang();
            $template->selectBoxes = $event->getSelects();
        }
    }


    /**
     * Erstellt den Inhalt des Widgets.
     * @param OnGenerateWidgetEvent $event
     */
    public function parseOutput(OnGenerateWidgetEvent $event): void
    {
        $template   = $event->getTemplate();

        if (null !== $template) {
            $output = $template->parse();
            $event->setOutput($output);
        }
    }
}
