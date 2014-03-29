<?php

namespace Knnf\WhatsupBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Knnf\WhatsupBundle\Entity\Article;
use Knnf\WhatsupBundle\Entity\User;
use Knnf\WhatsupBundle\Entity\Category;
use Knnf\WhatsupBundle\Entity\Media;
use Knnf\WhatsupBundle\Entity\Event;


class AdminController extends Controller
{
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();
        $articles = $em->getRepository('KnnfWhatsupBundle:Article')->findAll();
        $users = $em->getRepository('KnnfWhatsupBundle:User')->findAll();
        $categories = $em->getRepository('KnnfWhatsupBundle:Category')->findAll();
        $medias = $em->getRepository('KnnfWhatsupBundle:Media')->findAll();
        $events = $em->getRepository('KnnfWhatsupBundle:Event')->findAll();

        
        return $this->render('KnnfWhatsupBundle:Admin:index.html.twig', array(
           'articles' => $articles,
           'users' => $users,
           'categories' => $categories,
           'medias' => $medias,
           'events' => $events,
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
