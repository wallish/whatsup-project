<?php

namespace Knnf\WhatsupBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ArticleController extends Controller
{
    public function indexAction()
    {
        return $this->render('KnnfWhatsupBundle:Article:index.html.twig');
    }

    public function addAction()
    {
        return $this->render('KnnfWhatsupBundle:Article:add.html.twig');
    }

    public function editAction()
    {
        return $this->render('KnnfWhatsupBundle:Article:edit.html.twig');
    }

    public function deleteAction()
    {
    }

    public function activateAction()
    {
    }

}
