NavBar
-------

The KinwaeBootstrap Navbar section is dependant on the 'knplabs/knp-menu-bundle' bundle while in itself requires
the 'knplabs/knp-menu' lib

Adding Items to the NavBar
-----------------------------

To add Items to the Main NavBar, all you have to do is listen for the 'kinwae_bootstrap.menu.main_menu_creation' event.

This event is fired when the main menu bar is about to be created as a result of the function call 'kinwae_bootstrap_navbar'
in a twig template.

The fired event is an instance of the MenuCreationEvent class which gives you access to the root \Knp\Menu\MenuItem menuitem

All you have to do in your listener is to get the menu item and add or alter it to build the menu

#

kinwae_bootstrap.add_blog_menu:
              class: Kinwae\BootstrapBundle\Listeners\AddBlogMenu
              arguments: ["@service_container"] # what ever you need as an argument. But not that you are given access to the
                #service container via the MenuCreationEvent object you receive
              tags:
                  - {name: kernel.event_listener, event:kinwae_bootstrap.menu.main_menu_creation, method:onAddBlogMenu}

namespace Kinwae\BootstrapBundle\Listeners;

class AddBlogMenu{
    function onAddBlogMenu(MenuCreationEvent $event){
        $root = $event->getRootMenu
        $root->addChild('Blog', array('route' => '_blogs'));
    }
}


If your any reason, you which to alter the menu that has already been created somewhere else, then register for the

'kinwae_bootstrap.menu.main_menu_alteration'

event instead of the

'kinwae_bootstrap.menu.main_menu_creation'


the kinwae_bootstrap.menu.main_menu_alteration is fired after all listeners have added their menu to the menu tree

read the 'knplabs/knp-menu' documentation

 [KnpMenu](https://github.com/KnpLabs/KnpMenu/blob/master/doc/01-Basic-Menus.markdown)

 on how to work with knplabs/knp-menu menus

 Details about 'knplabs/knp-menu-bundle' bundle can also be found at https://github.com/KnpLabs/KnpMenuBundle/blob/master/Resources/doc

Rendering the Main Menu Nav Bar
---------------------------------------

in your twig template, you can render the main menu by calling the function

    {{kinwae_bootstrap_navbar()}}

if for example the name of the main menu service creator (which defaults to 'kinwae_bootstrap_main') is changed, the call
the function like so

    {{kinwae_bootstrap_navbar('<service_creator_name>')}}

the kinwae_bootstrap_navbar function takes in an optional second parameter as the options.
The options key include

    1.  'template': the template file that will used to render the bootstrap navbar. If it is not set, then it defaults to the
            value set in the app config

#config.yml

.....
kinwae_bootstrap:
    navbar_template: Nav:bar:template # defaults to 'KinwaeBootstrapBundle::bootstrap_nav_bar.html.twig'

    2.  'block': the block in the specified template file that will be used to render the navbar. defaults to 'navBar'
    3.  'brandName': Text that will be displayed in the brandName section of the twitter bootstrap navbar.
                    Please not that it is your responsibility to escape this value if need be as this value is outputted raw
                    in order to allow images and other html tags to be used for the brand name
    4.  'knp_menu_options': Any knplabs/knp-menu options that should originally be passed into 'knp_menu_render' twig function
                            see [KnpMenu](https://github.com/KnpLabs/KnpMenu/blob/master/doc/01-Basic-Menus.markdown)
                            for further details