<?php

namespace Kinwae\BootstrapBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('kinwae_bootstrap');
        $rootNode->children()
            ->scalarNode("navbar_template")->defaultValue("KinwaeBootstrapBundle::bootstrap_nav_bar.html.twig")->end()
            ->scalarNode("navbar_menu")->defaultValue("kinwae_bootstrap_main")->end()
            ->scalarNode("webroot")->defaultValue("web")->end()
            /**
             * the directory where bootstrap will be placed in. This is relative to the web root of the app
             */
            ->scalarNode("bootstrap_dir")->defaultValue("assets")->end()
            ->scalarNode("bootstrap_install_dir")->defaultValue("vendor/twitter/bootstrap/twitter/bootstrap")->end()
            ->scalarNode("bootstrap_name")->defaultValue("bootstrap")->end();
        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.

        return $treeBuilder;
    }
}
