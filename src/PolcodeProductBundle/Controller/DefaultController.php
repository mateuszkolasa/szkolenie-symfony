<?php

namespace PolcodeProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class DefaultController extends Controller {
    
    /**
     * @Route(name="app_homepage", path="/")
     */
    public function indexAction() {
        return $this->render('PolcodeProductBundle:Default:index.html.twig');
    }
    
}
