<?php

/**
 * @package     selectwizard
 * @since       14.02.2020 - 10:26
 * @author      Patrick Froch <info@easySolutionsIT.de>
 * @link        http://easySolutionsIT.de
 * @copyright   e@sy Solutions IT 2020
 * @license     LGPL-3.0-only
 */

declare(strict_types = 1);

namespace Esit\Selectwizard\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class EsitSelectwizardExtension extends Extension
{


    /**
     * Lädt die Konfigurationen
     * @param array            $mergedConfig
     * @param ContainerBuilder $container
     * @throws \Exception
     */
    public function load(array $mergedConfig, ContainerBuilder $container): void
    {
        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__ . '/../Resources/config')
        );

        if (\is_file(__DIR__ . '/../Resources/config/services.yml')) {
            $loader->load('services.yml');
        }

        if (\is_file(__DIR__ . '/../Resources/config/listener.yml')) {
            $loader->load('listener.yml');
        }
    }
}
