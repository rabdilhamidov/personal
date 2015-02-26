<?php

namespace Ra\PaginationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
    	return $this->render('RaPaginationBundle:Default:index.html.twig', array('name' => $name));
    }
}
