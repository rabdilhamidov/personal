<?php

namespace Application\Sonata\DoctrineORMAdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ApplicationSonataDoctrineORMAdminBundle:Default:index.html.twig', array('name' => $name));
    }
}
