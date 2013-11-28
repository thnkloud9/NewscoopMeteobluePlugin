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
     * @Route("/plugin/meteoblue/wetter")
     */
    public function indexAction(Request $request)
    {
        return $this->render('NewscoopMeteobluePluginBundle:Default:index.html.smarty');
    }

}
