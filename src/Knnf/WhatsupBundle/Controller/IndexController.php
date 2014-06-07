<?php

namespace Knnf\WhatsupBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Knnf\WhatsupBundle\Entity\User;

class IndexController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $favory1 = null;
        $favory2 = null;
		$favory3 = null;
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
        $articles1 = $em->getRepository('KnnfWhatsupBundle:Article')->findBy(array('sandbox' => 0,'activate' => '1'),array('dateinsert' => 'desc'));
        $articles2 = $em->getRepository('KnnfWhatsupBundle:Article')->findBy(array('sandbox' => 0,'activate' => '1'),array('dateinsert' => 'desc'));
        $articles3 = $em->getRepository('KnnfWhatsupBundle:Article')->findBy(array('sandbox' => 0,'activate' => '1'),array('dateinsert' => 'desc'));
        //die(var_dump($this->container->get('security.context')->getToken()->getUser()));
        $user = $this->container->get('security.context')->getToken()->getUser();
        $favory = $em->getRepository('KnnfWhatsupBundle:Setting')->findBy(array('user' => $user));
        if($favory){
            if($favory[0]->getCategory() != null){
                $favory1 = $em->getRepository('KnnfWhatsupBundle:Article')->findBy(array('sandbox' => 0,'activate' => '1','category' => $favory[0]->getCategory()),array('dateinsert' => 'desc'));
            }
            if($favory[0]->getCategory2() != null){
                $favory2 = $em->getRepository('KnnfWhatsupBundle:Article')->findBy(array('sandbox' => 0,'activate' => '1','category' => $favory[0]->getCategory2()),array('dateinsert' => 'desc'));
            }
            if($favory[0]->getCategory3() != null){
                $favory3 = $em->getRepository('KnnfWhatsupBundle:Article')->findBy(array('sandbox' => 0,'activate' => '1','category' => $favory[0]->getCategory3()),array('dateinsert' => 'desc'));
            }
        }
		$categories = $em->getRepository('KnnfWhatsupBundle:Category')->findAll();
        $articles = $em->getRepository('KnnfWhatsupBundle:Article')->findBy(array('sandbox' => 0,'activate' => '1'));
        
        $events = $em->getRepository('KnnfWhatsupBundle:Event')->findAll();
		$lookbooks = $em->getRepository('KnnfWhatsupBundle:Lookbook')->findBy(array(),array('dateinsert' => 'DESC'),2);
        $musiques = $em->getRepository('KnnfWhatsupBundle:Article')->findBy(array('category' => 5,'activate' => '1','sandbox' => 0),array('dateinsert' => 'desc'),2);
        $pushs = $em->getRepository('KnnfWhatsupBundle:Article')->findBy(array('sandbox' => 0,'push' => 1,'activate' => '1'));
    	
        return $this->render('KnnfWhatsupBundle:Index:index.html.twig',array(
    		'categories' => $categories,
            'articles' => $articles1,
            'articles1' => $articles1,
            'events' => $events,
            'musics' => $musiques,
            'push' => $pushs,
            'lookbooks' => $lookbooks,
            'favory1' => $favory1,
            'favory2' => $favory2,
            'favory3' => $favory3,
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

    public function footer(){

        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('KnnfWhatsupBundle:Media')->findAll();
        return $this->render('KnnfWhatsupBundle:Index:footer.html.twig',array(
            'media' => $media,

        ));
    }

    public function todoAction(){
        die('
            add gestion des droits <br/>
            add google analytics<br/>
            add organigramme front<br/><br/>
            add ordre catégorie menu <br/><br/>

            liste des articles <br/>
            liste des events <br/><br/>

            liste des articles user<br/>
            liste des events user<br/>
            liste des lookbooks user<br/><br/>

            fix bug edit article user<br/>
            fix bug edit event user<br/>
            fix bug edit user user<br/>
            fix bug organigramme back<br/><br/>

            fix responsive menu<br/>
            fix responsive agenda<br/>
            fix responsive footer<br/><br/>
            fix register view<br/>
            fix login view<br/><br/>
            fix datepicker color <br/>
            replace datepicker <br/>
            ');
    }

}
