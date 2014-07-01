<?php

namespace Knnf\WhatsupBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class StatController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $dailyComment = $em->getRepository('KnnfWhatsupBundle:Annotation')->getDailyComment();
        $dailySubscription = $em->getRepository('KnnfWhatsupBundle:User')->getDailySubscription();
        $dailyArticle = $em->getRepository('KnnfWhatsupBundle:Article')->getDailyArticle();
        $dailySignalement = $em->getRepository('KnnfWhatsupBundle:Annotation')->getDailySignalement();
        $totalUser = $em->getRepository('KnnfWhatsupBundle:User')->getTotalSubscription();
        $getCategoryView = $em->getRepository('KnnfWhatsupBundle:Article')->getCategoryView();
        $user_month = $em->getRepository('KnnfWhatsupBundle:Annotation')->getBestUserOfTheMonth3();
        $bar = $em->getRepository('KnnfWhatsupBundle:User')->findBy(array('id' => $user_month[0]['idUser']));
        $categoryMostView = $em->getRepository('KnnfWhatsupBundle:Category')->findBy(array('id' => $getCategoryView[0]['categoryid']));
        return $this->render('KnnfWhatsupBundle:Stat:index.html.twig',array(
         'dailyComment' =>  $dailyComment[0] ,
         'dailySubscription' =>  $dailySubscription[0] ,
         'dailyArticle' =>  $dailyArticle[0] ,
         'dailySignalement' =>  $dailySignalement[0] ,
         'totalUser' =>  $totalUser[0] ,
         'getCategoryView' =>  $getCategoryView[0]['views'] ,
         'categoryMostView' =>  $categoryMostView[0] ,
         'user' => $bar[0]

        ));
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
