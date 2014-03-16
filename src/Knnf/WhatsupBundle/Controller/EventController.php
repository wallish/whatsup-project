<?php

namespace Knnf\WhatsupBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EventController extends Controller
{
    public function indexAction()
    {
        return $this->render('KnnfWhatsupBundle:Event:index.html.twig');
    }

    public function addAction()
    {
        
        return $this->render('KnnfWhatsupBundle:Event:add.html.twig');
    }

    public function editAction()
    {
        return $this->render('KnnfWhatsupBundle:Event:edit.html.twig');
    }

    public function deleteAction()
    {
    }

    public function activateAction()
    {
    }

}
