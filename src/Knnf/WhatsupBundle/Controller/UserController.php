<?php

namespace Knnf\WhatsupBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Knnf\WhatsupBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query;

class UserController extends Controller
{
	protected function _getRepo(){
		return $this->getDoctrine()->getRepository('KnnfWhatsupBundle:User');
	}


    public function indexAction()
    {
    	$em = $this->getDoctrine()->getManager();
    	$foo = $this->_getRepo()->findAll();


    	var_dump($foo);

    	return $this->render('KnnfWhatsupBundle:User:index.html.twig',array('users' => $foo));
    }

    public function addAction(Request $request)
    {
    	if ($request->isMethod('POST')) {

	    	$user = new User();
		    $user->setFirstname("user".time());
		    $em = $this->getDoctrine()->getManager();

		    $em->persist($user);
		    $em->flush();
		}

    	return $this->render('KnnfWhatsupBundle:User:add.html.twig');
    }

    public function deleteAction(Request $request)
    {
    	$em = $this->getDoctrine()->getManager();
    	$foo = $this->_getRepo()->delete($request['id']);

    	return $this->render('KnnfWhatsupBundle:User:delete.html.twig');
    }

}
