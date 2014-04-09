<?php

namespace Knnf\WhatsupBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class StatController extends Controller
{
    public function indexAction()
    {

        return $this->render('KnnfWhatsupBundle:Stat:index.html.twig');
    }
     public function googleAction()
    {
        return $this->render('KnnfWhatsupBundle:Stat:google.html.twig');
      
    }
     public function facebookAction()
    {
        return $this->render('KnnfWhatsupBundle:Stat:facebook.html.twig');
    }
     public function twitterAction()
    {
        return $this->render('KnnfWhatsupBundle:Stat:twitter.html.twig');
    }
}
