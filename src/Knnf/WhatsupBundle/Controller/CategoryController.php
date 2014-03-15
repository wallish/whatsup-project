<?php

namespace Knnf\WhatsupBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CategoryController extends Controller
{
    public function indexAction()
    {
        return $this->render('KnnfWhatsupBundle:Category:index.html.twig');
    }

    public function addAction()
    {
        return $this->render('KnnfWhatsupBundle:Category:add.html.twig');
    }

    public function editAction()
    {
        return $this->render('KnnfWhatsupBundle:Category:edit.html.twig');
    }

    public function deleteAction()
    {
        
    }

    public function activateAction()
    {

    }

}
