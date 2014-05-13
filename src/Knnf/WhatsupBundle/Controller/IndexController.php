<?php

namespace Knnf\WhatsupBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Knnf\WhatsupBundle\Entity\User;

class IndexController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
    		
        /*
        // Pour récupérer le service UserManager du bundle
        $userManager = $this->get('fos_user.user_manager');
        // Pour charger un utilisateur
        $user = $userManager->findUserBy(array('username' => 'popo'));

        die(var_dump($user));
        // Pour modifier un utilisateur
        $user->setEmail('cetemail@nexiste.pas');
        $userManager->updateUser($user); // Pas besoin de faire un flush avec l'EntityManager, cette méthode le fait toute seule !
        // Pour supprimer un utilisateur
        $userManager->deleteUser($user);
        // Pour récupérer la liste de tous les utilisateurs
        $users = $userManager->findUsers();
        */



		$categories = $em->getRepository('KnnfWhatsupBundle:Category')->findAll();
        $articles = $em->getRepository('KnnfWhatsupBundle:Article')->findBy(array('sandbox' => 0,'activate' => '1'));
		$events = $em->getRepository('KnnfWhatsupBundle:Event')->findAll();
        $musiques = $em->getRepository('KnnfWhatsupBundle:Article')->findBy(array('category' => 5,'activate' => '1','sandbox' => 0),array('dateinsert' => 'desc'),2);
        $pushs = $em->getRepository('KnnfWhatsupBundle:Article')->findBy(array('sandbox' => 0,'push' => 1,'activate' => '1'));
    	return $this->render('KnnfWhatsupBundle:Index:index.html.twig',array(
    		'categories' => $categories,
    		'articles' => $articles,
            'events' => $events,
            'musics' => $musiques,
            'push' => $pushs,
        ));

    }

    public function menuAction()
    {
    	$em = $this->getDoctrine()->getManager();
    	$categories = $em->getRepository('KnnfWhatsupBundle:Category')->findBy(array('activate' => 1,'category' => null));

    	return $this->render('KnnfWhatsupBundle:Index:menu.html.twig',array(
    		'categories' => $categories,

    	));
    }

}
