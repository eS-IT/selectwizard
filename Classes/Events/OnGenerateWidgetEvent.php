<?php declare(strict_types = 1);
/**
 * @package     Selectwizard
 * @filesource  OnGenerateWidgetEvent.php
 * @version     1.0.0
 * @since       14.02.2020 - 10:26
 * @author      Patrick Froch <info@easySolutionsIT.de>
 * @see         http://easySolutionsIT.de
 * @copyright   e@sy Solutions IT 2020
 * @license     LGPLv3
 */
namespace Esit\Selectwizard\Classes\Events;

use Contao\BackendTemplate;
use Symfony\Contracts\EventDispatcher\Event;

/**
 * Class OnGenerateWidgetEvent
 * @package Esit\Selectwizard\Classes\Events
 */
class OnGenerateWidgetEvent extends Event
{


    /**
     * Name des Events
     */
    public const NAME = 'on.generate.widget.event';


    /**
     * Liste der CSS-Dateien
     * @var array
     */
    protected $tlCss = [];


    /**
     * Liste der JavaScript-Dateien
     * @var array
     */
    protected $tlJavascript = [];


    /**
     * Id über dass das Feld angesprochen werden kann
     * @var string
     */
    protected $fieldId = '';


    /**
     * Label für das Widget
     * @var string
     */
    protected $label = '';


    /**
     * Werte des Eingabefelds
     * @var array
     */
    protected $values = [];


    /**
     * Konfiguration des Widgets
     * @var array
     */
    protected $configuration = [];


    /**
     * Sprachdatei für die Übersetzung
     * @var array
     */
    protected $mscLang = [];


    /**
     * Array mit den einzelnen Widgets der Auswahlfelder
     * @var array
     */
    protected $selects = [];


    /**
     * Name des Widget-Templates
     * @var string
     */
    protected $templateName = '';


    /**
     * Template-Objekt
     * @var BackendTemplate
     */
    protected $template;


    /**
     * Output des Widgets
     * @var string
     */
    protected $output = '';


    /**
     * @return array
     */
    public function getTlCss(): array
    {
        return $this->tlCss;
    }


    /**
     * @param array $tlCss
     */
    public function setTlCss(array $tlCss): void
    {
        $this->tlCss = $tlCss;
    }


    /**
     * @return array
     */
    public function getTlJavascript(): array
    {
        return $this->tlJavascript;
    }


    /**
     * @param array $tlJavascript
     */
    public function setTlJavascript(array $tlJavascript): void
    {
        $this->tlJavascript = $tlJavascript;
    }


    /**
     * @return string
     */
    public function getFieldId(): string
    {
        return $this->fieldId;
    }


    /**
     * @param string $fieldId
     */
    public function setFieldId(string $fieldId): void
    {
        $this->fieldId = $fieldId;
    }


    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }


    /**
     * @param string $label
     */
    public function setLabel(string $label): void
    {
        $this->label = $label;
    }


    /**
     * @return array
     */
    public function getValues(): array
    {
        return $this->values;
    }


    /**
     * @param array $values
     */
    public function setValues(array $values): void
    {
        $this->values = $values;
    }


    /**
     * @return array
     */
    public function getConfiguration(): array
    {
        return $this->configuration;
    }


    /**
     * @param array $configuration
     */
    public function setConfiguration(array $configuration): void
    {
        $this->configuration = $configuration;
    }


    /**
     * @return array
     */
    public function getMscLang(): array
    {
        return $this->mscLang;
    }


    /**
     * @param array $mscLang
     */
    public function setMscLang(array $mscLang): void
    {
        $this->mscLang = $mscLang;
    }


    /**
     * @return array
     */
    public function getSelects(): array
    {
        return $this->selects;
    }


    /**
     * @param array $selects
     */
    public function setSelects(array $selects): void
    {
        $this->selects = $selects;
    }


    /**
     * @return string
     */
    public function getTemplateName(): string
    {
        return $this->templateName;
    }


    /**
     * @param string $templateName
     */
    public function setTemplateName(string $templateName): void
    {
        $this->templateName = $templateName;
    }


    /**
     * @return BackendTemplate
     */
    public function getTemplate(): ?BackendTemplate
    {
        return $this->template;
    }


    /**
     * @param BackendTemplate $template
     */
    public function setTemplate(BackendTemplate $template): void
    {
        $this->template = $template;
    }


    /**
     * @return string
     */
    public function getOutput(): string
    {
        return $this->output;
    }


    /**
     * @param string $output
     */
    public function setOutput(string $output): void
    {
        $this->output = $output;
    }
}
