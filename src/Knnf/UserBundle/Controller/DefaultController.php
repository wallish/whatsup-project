<?php

namespace Knnf\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('KnnfUserBundle:Default:index.html.twig', array('name' => $name));
    }
}
