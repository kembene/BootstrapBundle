<?php
namespace Kinwae\BootstrapBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
class DefaultController extends Controller
{
    /**
     * @Template
     */
    function indexAction(){
        return array();
    }
}
