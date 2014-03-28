<?php

namespace Knnf\WhatsupBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    public function indexAction()
    {
        return $this->render('KnnfWhatsupBundle:Admin:index.html.twig', array(
           
        ));
    }

    public function articleAction()
    {
        return $this->render('KnnfWhatsupBundle:Admin:article.html.twig', array(
           
        ));
    }

    public function userAction()
    {
        return $this->render('KnnfWhatsupBundle:Admin:user.html.twig', array(
           
        ));
    }

    public function categoryAction()
    {
        return $this->render('KnnfWhatsupBundle:Admin:category.html.twig', array(
           
        ));
    }

    public function mediaAction()
    {
        return $this->render('KnnfWhatsupBundle:Admin:media.html.twig', array(
           
        ));
    }

    public function eventAction()
    {
        return $this->render('KnnfWhatsupBundle:Admin:event.html.twig', array(
           
        ));
    }

}
