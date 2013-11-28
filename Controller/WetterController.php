<?php

namespace Newscoop\MeteobluePluginBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class WetterController extends Controller
{
    /**
     * @Route("/plugin/meteoblue/header")
     */
    public function headerAction(Request $request)
    {
        return $this->render('NewscoopMeteobluePluginBundle:Default:header.html.smarty');
    }

     /**
     * Show details page 
     * 
     * @Route("/plugin/meteoblue/details")
     */
    public function detailsAction()
    {
        return $this->render('NewscoopMeteobluePluginBundle:Default:details.html.smarty');
    }


}
