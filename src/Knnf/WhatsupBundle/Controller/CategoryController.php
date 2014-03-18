<?php

namespace Knnf\WhatsupBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CategoryController extends Controller
{
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();
        $category = $this->_getRepo()->findAll();

        return $this->render('KnnfWhatsupBundle:Category:index.html.twig',array('category' => $category));
    }

    public function addAction()
    {
         if ($request->isMethod('POST')) {
            $data = $request->request->all();
            $result = $this->_getRepository()->save($data['form']);
        }
        return $this->render('KnnfWhatsupBundle:Category:add.html.twig');
    }

    public function editAction()
    {
        return $this->render('KnnfWhatsupBundle:Category:edit.html.twig');
    }

    public function deleteAction()
    {
        if ($request->isMethod('POST')) {
            $data = $request->request->all();
            $article = $this->_getRepository()->delete($data['id']);
        }
    }

   public function activateAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        if ($request->isMethod('POST')) {
            if(!$id) die('Missing parameter');
            $data = $request->request->all();
            $foo = $this->_getRepository()->save($data['form']);
        }   
    }

}
