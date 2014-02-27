<?php

namespace Knnf\WhatsupBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
    	return $this->render('KnnfWhatsupBundle:Index:index.html.twig');
    }

}
