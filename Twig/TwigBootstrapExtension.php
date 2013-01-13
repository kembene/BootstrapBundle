<?php
namespace Kinwae\BootstrapBundle\Twig;
use Symfony\Component\DependencyInjection\ContainerInterface;
class TwigBootstrapExtension extends \Twig_Extension
{

    private $container;

    function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getFunctions()
    {
        return array(
            'kinwae_bootstrap_navbar' => new \Twig_Function_Method($this,"renderNavbar",array("is_safe"=>array("html")))
        );
    }

    function renderNavbar($menuName=null, $options = array()){
        //retrieve variables
        $template = $this->container->getParameter("kinwae_bootstrap.navbar_template");
        $block = "navBar";
        if($menuName == null){
            $menuName = $this->container->getParameter("kinwae_bootstrap.navbar_menu");
        }
        if(isset($options['template'])){
            $template = $options['template'];
        }
        if(isset($options['block'])){
            $block = $options['block'];
        }
        unset($options['template']);
        unset($options['block']);
        $twig = $this->getTwig();

        if (!$template instanceof \Twig_Template) {
            try {
                $template = $twig->loadTemplate($template);
            } catch (\ErrorException $e) {
                throw new \Exception("Could not load template: " . $template, 99, $e);
            }
        }

        $options['menuName'] = $menuName;
        if(!isset($options['knp_menu_options'])){
            $options['knp_menu_options'] = array();
        }
        $html = $template->renderBlock($block,$options);
        return $html;

    }

    /**
     * @return \Twig_Environment
     */
    function getTwig(){
        return $this->container->get("twig");
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return "kinwae_bootstrap_extension";
    }
}
