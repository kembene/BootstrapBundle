<?php
namespace Kinwae\BootstrapBundle\Events;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Knp\Menu\MenuItem;
class MenuCreationEvent extends Event
{
    const MAIN_MENU_CREATION = "kinwae_bootstrap.menu.main_menu_creation";
    const MAIN_MENU_ALTERATION = "kinwae_bootstrap.menu.main_menu_alteration";
    /**
     * @var MenuItem
     */
    private $rootItem;
    /**
     * @var ContainerInterface
     */
    private $container;
    function __construct(ContainerInterface $container, MenuItem $rootItem)
    {
        $this->container = $container;
        $this->rootItem = $rootItem;
    }

    /**
     * @return \Symfony\Component\DependencyInjection\ContainerInterface
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * @return \Knp\Menu\MenuItem
     */
    public function getRootMenu()
    {
        return $this->rootItem;
    }


}
