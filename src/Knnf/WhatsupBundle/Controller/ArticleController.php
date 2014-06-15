<?php

namespace Knnf\WhatsupBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Knnf\WhatsupBundle\Entity\Article;
use Knnf\WhatsupBundle\Entity\User;
use Knnf\WhatsupBundle\Form\ArticleType;
use Doctrine\ORM\Query;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Response;
/**
 * Article controller.
 *
 */
class ArticleController extends Controller
{

    protected function _getRepository()
    {
        return $this->getDoctrine()->getRepository('KnnfWhatsupBundle:Article');
    }

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('KnnfWhatsupBundle:Article')->findAll();
        $categories = $em->getRepository('KnnfWhatsupBundle:Category')->findAll();
        return $this->render('KnnfWhatsupBundle:Article:index.html.twig', array(
            'entities' => $entities,
            'categories' => $categories,
        ));
    }

    //Récupération des commentaires d'un article, avec gestion des droits pour l'affichage du champ de saisie de commentaire
    public function commentAction($article_id)
    {
        $em = $this->getDoctrine()->getManager();
        $comments = $em->getRepository('KnnfWhatsupBundle:Annotation')->findBy(array("idArticle"=>$article_id,"AnnotationType" => "comments"));

        return $this->render("KnnfWhatsupBundle:Article:comment.html.twig", array(
            "comments"=>$comments
        ));
    }



    //Récupération de l'article du mois
    public function articleOfTheMonthAction($category = null)
    {
        $em = $this->getDoctrine()->getManager();
        if($category != null)
        {
            $query = $em->createQuery(
                'SELECT art
                FROM KnnfWhatsupBundle:Article art
                WHERE art.dateinsert like :month
                AND art.category = :category
                ORDER BY art.views DESC'
            )->setParameters(array(
                'month' => date('Y').'-'.date('m').'%',
                'category' => $category,
            ))->setMaxResults(1);
        }
        else 
        {
            $query =  $em->createQuery(
                'SELECT art
                FROM KnnfWhatsupBundle:Article art
                WHERE art.dateinsert like :month
                ORDER BY art.views DESC'
            )->setParameter(
                'month', date('Y').'-'.date('m').'%'
            )->setMaxResults(1);
        }
        try 
        {
            $article = $query->getSingleResult();
        } 
        catch (\Doctrine\Orm\NoResultException $e) 
        {
            $article = null;
        }

      
        //die(var_dump($article));
        
        //die(var_dump($article));
        return $this->render("KnnfWhatsupBundle:Article:articleofthemonth.html.twig", array("article"=>$article));
    }



    //Récupération de l'auteur du mois
    public function authorOfTheMonthAction($category = null) 
    {
        $em = $this->getDoctrine()->getManager();
        if($category != null)
        {
            $query = $em->createQuery(
                'SELECT IDENTITY(art.user), sum(art.views) as nviews
                FROM KnnfWhatsupBundle:Article art
                WHERE art.category = :category
                AND art.dateinsert like :month
                GROUP BY art.user
                ORDER BY nviews DESC'
            )->setParameters(array(
                'month' => date('Y').'-'.date('m').'%',
                'category' => $category

            ))->setMaxResults(1);
        }
        else
        {
            $query = $em->createQuery(
                'SELECT IDENTITY(art.user), sum(art.views) as nviews
                FROM KnnfWhatsupBundle:Article art
                WHERE art.dateinsert like :month
                GROUP BY art.user
                ORDER BY nviews DESC'
            )->setParameter(
                'month', date('Y').'-'.date('m').'%'
            )->setMaxResults(1);
        }

        try 
        {
            $result = $query->getSingleResult();
        } 
        catch (\Doctrine\Orm\NoResultException $e) 
        {
            $article = null;
        }
        //echo "<pre>".print_r($result,true)."</pre>";
        $user = $em->getRepository('KnnfWhatsupBundle:User')->findOneBy(array("id"=>$result['1']));
        //echo "<pre>".print_r($result,true)."</pre>";
        return $this->render("KnnfWhatsupBundle:Article:userofthemonth.html.twig", array("user"=>$user));

    }

    //Liste les articles d'une catégorie donnée
    public function categoryArticlesAction($category, $limit = 0)
    {
        $em = $this->getDoctrine()->getManager();
        $articles = $em->getRepository("KnnfWhatsupBundle:Article")->findBy(array("category" => $category), null, $limit);
        
        return $this->render("KnnfWhatsupBundle:Article:miniListArticles.html.twig", array(
            "articles"=>$articles
        ));
    }

    //Récupéraiton des articles d'un auteur 
    public function authorArticlesAction($author, $limit = 0)
    {
        $em = $this->getDoctrine()->getManager();
        $articles = $em->getRepository("KnnfWhatsupBundle:Article")->findBy(array("user" => $author,'activate' => 1), null, $limit);

        return $this->render("KnnfWhatsupBundle:Article:miniListArticles.html.twig", array(
            "articles"=>$articles
        ));
    }

    //Récupéraiton des articles les plus vue de l'auteur
    public function authorMostViewArticlesAction($author, $limit = 0)
    {
        $em = $this->getDoctrine()->getManager();
        $articles = $em->getRepository("KnnfWhatsupBundle:Article")->findBy(array("user" => $author,'activate' => 1), array('views' => 'ASC'), $limit);

        return $this->render("KnnfWhatsupBundle:Article:miniListArticles.html.twig", array(
            "articles"=>$articles
        ));
    }

    public function showAction(Request $request,$slug)
    {
        $em = $this->getDoctrine()->getManager();

        $tata = $request->getClientIp();


        

        $user = $this->container->get('security.context')->getToken()->getUser();
        $user = $em->getRepository("KnnfWhatsupBundle:User")->findBy(array("id" => 2));
        $entity = $em->getRepository('KnnfWhatsupBundle:Article')->findOneBy(array("slug"=>$slug));
        
       
        if(!$request->cookies->get('cookie'.$slug)){
            $entity->setViews($entity->getViews() + 1);
            $em->persist($entity);
            $em->flush();

            $cookie = new Cookie('cookie'.$slug, 1, time() + 3600 * 24 * 7);
           
            $response = new Response();
            $response->headers->setCookie($cookie);
            $response->send();
        }
        
        if($entity == null)
            $entity = $em->getRepository('KnnfWhatsupBundle:Article')->findOneBy(array("id"=>$slug));
        
        $like = $em->getRepository('KnnfWhatsupBundle:Annotation')->findBy(array("idArticle"=>$entity,'AnnotationType' => 'like'));
        
        $comments = $em->getRepository('KnnfWhatsupBundle:Annotation')->findBy(array("idArticle"=>$entity,'AnnotationType' => 'comments'));
        
        $userlikes = $em->getRepository('KnnfWhatsupBundle:Annotation')->findBy(array("idArticle"=>$entity->getId(),'AnnotationType' => 'like','user' => $user));
        $categories = $em->getRepository('KnnfWhatsupBundle:Category')->findAll();
        
        if (!$entity) throw $this->createNotFoundException('Unable to find Article entity.');
        return $this->render('KnnfWhatsupBundle:Article:show.html.twig', array(
            'article'      => $entity,
            'nblike' => count($like),
            'nbcomments' => count($comments),
            'userlikes' => count($userlikes),
            'current_url' => "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]",
            'nbview' => $entity->getViews(),
            'categories' => $categories

        ));
    }

    public function addAction(Request $request,$id=null)
    {
        $entity = new Article();
        $form = $this->createForm(new ArticleType(), $entity, array(
            'action' => $this->generateUrl('admin_add_article'),
            'method' => 'POST',
        ));
            $em = $this->getDoctrine()->getManager();
        
        $form->add('publish', 'submit', array('label' => 'Soumettre','attr' => array('class' => 'btn btn-primary btn-sm')));
        $form->add('sandbox', 'submit', array('label' => 'Enregistrer comme brouillon','attr' => array('class' => 'btn btn-warning btn-sm')));
        //$form->add('submit', 'submit', array('label' => 'Mettre à jour','attr' => array('class' => 'btn btn-default btn-sm')));
        $user = $em->getRepository("KnnfWhatsupBundle:User")->findBy(array("id" => 2));
        $form->handleRequest($request);

        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $entity->setSandbox($form->get('sandbox')->isClicked() ? '1' : '0');
            $user = $this->container->get('security.context')->getToken()->getUser();
            
            $entity->setUser($user);
            $entity->setActivate(0);
            $entity->setSlug($this->to_slug($entity->getTitle()));
            
            $entity->upload();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('article_edit', array('id' => $entity->getId())));
        }

        return $this->render('KnnfWhatsupBundle:Article:add.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'user' => $user,
        ));
    }

    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('KnnfWhatsupBundle:Article')->find($id);
        $user = $em->getRepository("KnnfWhatsupBundle:User")->findBy(array("id" => 2));

        if (!$entity) throw $this->createNotFoundException('Unable to find Article entity.');
        
        $editForm = $this->createForm(new ArticleType(), $entity, array(
            'action' => $this->generateUrl('article_edit', array('id' => $entity->getId(),'path' => $entity->getAbsolutePath())),
            'method' => 'PUT',
        ));

        if($entity->getSandbox()){
            $editForm->add('publish', 'submit', array('label' => 'Soumettre','attr' => array('class' => 'btn btn-primary btn-sm')));
            $editForm->add('sandbox', 'submit', array('label' => 'Enregistrer comme brouillon','attr' => array('class' => 'btn btn-warning btn-sm')));
        }
        else{
            $editForm->add('submit', 'submit', array('label' => 'Mettre à jour','attr' => array('class' => 'btn btn-default btn-sm')));
        }

        $editForm->handleRequest($request);

        //die(var_dump($editForm->getErrorsAsString()));
        //die(var_dump($editForm->isValid()));
        if ($editForm->isValid()) {
            //$entity->setSandbox($editForm->get('sandbox')->isClicked() ? '1' : '0');

            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'notice',
                'Your changes were saved!'
            );

            return $this->redirect($this->generateUrl('article_edit', array('id' => $id)));
        }
         return $this->render('KnnfWhatsupBundle:Article:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'user' => $user
        ));
    }
    public function deleteAction(Request $request)
    {
        if ($request->isMethod('POST')) {
            $data = $request->request->all();
            if(!$data['id']) die('Missing parameter');
            $em = $this->getDoctrine()->getManager();
            $articles = $em->getRepository('KnnfWhatsupBundle:Article')->findBy(array('id' => $data['id']));
            $em->remove($articles[0]);
            $em->flush();
        }

        return $this->render('KnnfWhatsupBundle:Article:delete.html.twig');
        //return true;

    }

    public function activateAction(Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        if ($request->isMethod('POST')) {
            $data = $request->request->all();
            if(!$data['id']) die('Missing parameter');

            $entity = $em->getRepository('KnnfWhatsupBundle:Article')->find($data['id']);

            if($entity->getActivate() == 1)
                $entity->setActivate(0);
            else
                $entity->setActivate(1);

            $em->persist($entity);
            $em->flush();
            die();
            
        }   
    }



    public function getArticlesAction(Request $request)
    {
        /*$em = $this->getDoctrine()->getManager();
        $article = $em->getRepository('KnnfWhatsupBundle:Article')->findAll(Query::HYDRATE_ARRAY);*/
        $em = $this->getDoctrine()->getEntityManager();
        $query = $em->createQuery('SELECT a FROM KnnfWhatsupBundle:Article a WHERE a.sandbox = 0 AND a.activate = 1');
        $myArray = $query->getArrayResult();
        die(json_encode((($myArray))));
        return new Response();
    }

    function to_slug($string){
        return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string)));
    }

    function getFbLike($url){
        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $json = file_get_contents('https://api.facebook.com/method/fql.query?query=select%20total_count,like_count,comment_count,share_count,click_count%20from%20link_stat%20where%20url=%27'.$url.'%27&format=json');
        return json_decode($json);
    }


    public function voteeAction(Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        if ($request->isMethod('POST')) {
            $data = $request->request->all();
            if(!$data['id']) die('Missing parameter');

            $entity = $em->getRepository('KnnfWhatsupBundle:Article')->find($data['id']);

            if($entity->getActivate() == 1)
                $entity->setActivate(0);
            else
                $entity->setActivate(1);

            $em->persist($entity);
            $em->flush();
            die();
            
        }   
    }
}
