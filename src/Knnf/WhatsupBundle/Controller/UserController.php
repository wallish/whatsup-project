<?php

namespace Knnf\WhatsupBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Knnf\WhatsupBundle\Entity\User;

class UserController extends Controller
{
	private $_em;

	

    public function indexAction()
    {
    	return $this->render('KnnfWhatsupBundle:User:index.html.twig');
    }

    public function addAction()
    {

    	$user = new User();
	    $user->setFirstname("user".time());
	    $em = $this->getDoctrine()->getManager();
	    $em->persist($user);
	    $em->flush();

    	return $this->render('KnnfWhatsupBundle:User:add.html.twig');
    }

    public function deleteAction()
    {
    	return $this->render('KnnfWhatsupBundle:User:delete.html.twig');
    }

}
