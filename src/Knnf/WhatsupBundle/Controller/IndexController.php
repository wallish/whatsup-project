<?php

namespace Knnf\WhatsupBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Knnf\WhatsupBundle\Entity\User;

class IndexController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
    		
		//$categories = $em->getRepository('KnnfWhatsupBundle:Category')->findAll();
    	return $this->render('KnnfWhatsupBundle:Index:index.html.twig');
    }

    public function menuAction()
    {
    	$em = $this->getDoctrine()->getManager();
    	$categories = $em->getRepository('KnnfWhatsupBundle:Category')->findAll();

    	return $this->render('KnnfWhatsupBundle:Index:menu.html.twig',array(
    		'categories' => $categories,
    	));
    }

}
