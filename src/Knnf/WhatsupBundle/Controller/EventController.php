<?php

namespace Knnf\WhatsupBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EventController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $events = $this->_getRepo()->findAll();

        return $this->render('KnnfWhatsupBundle:Event:index.html.twig',array('events' => $events));
    }

    public function addAction()
    {
        if ($request->isMethod('POST')) {
            $data = $request->request->all();
            $result = $this->_getRepository()->save($data['form']);
        }   
        return $this->render('KnnfWhatsupBundle:Event:add.html.twig');
    }

    public function editAction()
    {
        return $this->render('KnnfWhatsupBundle:Event:edit.html.twig');
    }

    public function deleteAction()
    {
        if ($request->isMethod('POST')) {
            $data = $request->request->all();
            if(!$id) die('Missing parameter');

            $article = $this->_getRepository()->delete($data['id']);
        }
    }

   public function activateAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        if ($request->isMethod('POST')) {
            $data = $request->request->all();
            if(!$id) die('Missing parameter');

            $foo = $this->_getRepository()->save($data['form']);
        }   
    }

}
