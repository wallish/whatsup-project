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
    	$users = $this->_getRepo()->findAll();

    	return $this->render('KnnfWhatsupBundle:User:index.html.twig',array('users' => $users));
    }

    public function addAction(Request $request)
    {
	    if ($request->isMethod('POST')) {
            $data = $request->request->all();
            $foo = $this->_getRepository()->save($data['form']);
        }

    	return $this->render('KnnfWhatsupBundle:User:add.html.twig');
    }

    public function deleteAction(Request $request)
    {
    	if ($request->isMethod('POST')) {
            $data = $request->request->all();
            if(!$$data['id']) die('Missing parameter');

            $article = $this->_getRepository()->delete($data['id']);
        }

    	return $this->render('KnnfWhatsupBundle:User:delete.html.twig');
    }

    public function activateAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        if ($request->isMethod('POST')) {
            $data = $request->request->all();
            if(!$$data['id']) die('Missing parameter');

            $foo = $this->_getRepository()->save($data['form']);
        }   
    }

}
