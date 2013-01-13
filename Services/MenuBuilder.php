<?php
namespace Kinwae\BootstrapBundle\Services;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Knp\Menu\MenuFactory;
use Kinwae\BootstrapBundle\Events\MenuCreationEvent;
class MenuBuilder
{
    protected $factory;

    function __construct(MenuFactory $factory)
    {
        $this->factory = $factory;
    }


    function createMainMenu(ContainerInterface $container){
        $rootMenu = $this->factory->createItem("main-menu");
        $home = $rootMenu->addChild('Homee <b class="caret"></b>', array('route' => '_bootstrap_index'));
        $home->setLinkAttribute("class","dropdown-toggle");
        $home->setLinkAttribute("data-toggle","dropdown");

        $home->setExtra("safe_label",true);
        $home->setChildrenAttribute("class","dropdown-menu");
        $home->addChild("Come", array('route' => '_bootstrap_index'));
        $rootMenu->setChildrenAttribute("class","nav");

        $dispatcher = $container->get("event_dispatcher");
        $evn = new MenuCreationEvent($container,$rootMenu);
        $dispatcher->dispatch(MenuCreationEvent::MAIN_MENU_CREATION,$evn);
        $dispatcher->dispatch(MenuCreationEvent::MAIN_MENU_ALTERATION,$evn);
        return $evn->getRootMenu();
    }
}
