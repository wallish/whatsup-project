<?php

namespace Knnf\WhatsupBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Knnf\WhatsupBundle\Entity\User;

class IndexController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
    		
		$categories = $em->getRepository('KnnfWhatsupBundle:Category')->findAll();
		$articles = $em->getRepository('KnnfWhatsupBundle:Article')->findAll();
    	return $this->render('KnnfWhatsupBundle:Index:index.html.twig',array(
    		'categories' => $categories,
    		'articles' => $articles
    	));
    }

}
