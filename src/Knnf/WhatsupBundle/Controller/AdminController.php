<?php

namespace Knnf\WhatsupBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Knnf\WhatsupBundle\Entity\Article;
use Knnf\WhatsupBundle\Entity\Annotation;
use Knnf\WhatsupBundle\Entity\User;
use Knnf\WhatsupBundle\Entity\Category;
use Knnf\WhatsupBundle\Entity\Media;
use Knnf\WhatsupBundle\Entity\Event;
use Knnf\WhatsupBundle\Entity\Organigramme;
use Symfony\Component\HttpFoundation\Request;
use Knnf\WhatsupBundle\Form\UserType;
use Knnf\WhatsupBundle\Form\ArticleType;
use Knnf\WhatsupBundle\Form\CategoryType;
use Knnf\WhatsupBundle\Form\OrganigrammeType;
use Knnf\WhatsupBundle\Form\MediaType;
use Knnf\WhatsupBundle\Form\EventType;
use Knnf\WhatsupBundle\Form\AnnotationType;


class AdminController extends Controller
{
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();
        $articles = $em->getRepository('KnnfWhatsupBundle:Article')->findAll();
       // $users = $em->getRepository('KnnfWhatsupBundle:User')->findAll();
        $categories = $em->getRepository('KnnfWhatsupBundle:Category')->findAll();
        $medias = $em->getRepository('KnnfWhatsupBundle:Media')->findAll();
        $events = $em->getRepository('KnnfWhatsupBundle:Event')->findAll();
        $annotations = $em->getRepository('KnnfWhatsupBundle:Annotation')->findAll(array('annotationtype' => 'signalement'));
        $users = $em->getRepository('KnnfWhatsupBundle:User')->findAll();
        $lookbooks = $em->getRepository('KnnfWhatsupBundle:Lookbook')->findAll();
        
        return $this->render('KnnfWhatsupBundle:Admin:index.html.twig', array(
           'articles' => $articles,
         //  'users' => $users,
           'categories' => $categories,
           'medias' => $medias,
           'events' => $events,
           'annotations' => $annotations,
           'users' => $users,
           'lookbooks' => $lookbooks,
        ));
    }



   

  

    public function addUserAction(Request $request)
    {
        $entity = new User();
        $form = $this->createForm(new UserType(), $entity, array(
            'action' => $this->generateUrl('admin_add_user'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_add_user', array('id' => $entity->getId())));
        }

        return $this->render('KnnfWhatsupBundle:Admin:adduser.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function edituserAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('KnnfWhatsupBundle:User')->find($id);

        if (!$entity) throw $this->createNotFoundException('Unable to find User entity.');
        

        $editForm = $this->createForm(new UserType(), $entity, array(
            'action' => $this->generateUrl('admin_edit_user', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $editForm->add('submit', 'submit', array('label' => 'Update'));

        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_edit_user', array('id' => $id)));
        }

        return $this->render('KnnfWhatsupBundle:Admin:edituser.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
        ));
    }

    public function addArticleAction(Request $request,$id=null)
    {
        $entity = new Article();
        $form = $this->createForm(new ArticleType(), $entity, array(
            'action' => $this->generateUrl('admin_add_article'),
            'method' => 'POST',
        ));
        $form->add('submit', 'submit', array('label' => 'Créer'));
        $form->add('publish', 'submit', array('label' => 'Soumettre','attr' => array('class' => 'btn btn-primary btn-sm')));
        $form->add('sandbox', 'submit', array('label' => 'Enregistrer comme brouillon'));
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity->setSandbox($form->get('sandbox')->isClicked() ? '1' : '0');
            //if($entity->slug != null)
            $entity->setSlug($this->to_slug($entity->getTitle()));
            
            $entity->upload();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_edit_article', array('id' => $entity->getId())));
        }

        return $this->render('KnnfWhatsupBundle:Admin:addarticle.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function editArticleAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('KnnfWhatsupBundle:Article')->find($id);

        if (!$entity) throw $this->createNotFoundException('Unable to find Article entity.');
        
        $editForm = $this->createForm(new ArticleType(), $entity, array(
            'action' => $this->generateUrl('admin_edit_article', array('id' => $entity->getId(),'path' => $entity->getAbsolutePath())),
            'method' => 'PUT',
        ));

        if($entity->getSandbox()){
            $editForm->add('publish', 'submit', array('label' => 'Publier'));
            $editForm->add('sandbox', 'submit', array('label' => 'Enregistrer comme brouillon'));
        }
        else{
            $editForm->add('submit', 'submit', array('label' => 'Mettre à jour'));
        }

        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $entity->setSandbox($form->get('sandbox')->isClicked() ? '1' : '0');

            $em->flush();
            $this->get('session')->getFlashBag()->add(
            'notice',
            'Your changes were saved!'
        );
            return $this->redirect($this->generateUrl('admin_edit_article', array('id' => $id)));
        }

        return $this->render('KnnfWhatsupBundle:Admin:editarticle.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
        ));
    }

        public function addcategoryAction(Request $request)
    {
        $entity = new Category();

        $form = $this->createForm(new CategoryType(), $entity, array(
            'action' => $this->generateUrl('admin_add_category'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity->setActivate(1);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_edit_category', array('id' => $entity->getId())));
        }

        return $this->render('KnnfWhatsupBundle:Admin:addcategory.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }


 

    public function editcategoryAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('KnnfWhatsupBundle:Category')->find($id);

        if (!$entity) throw $this->createNotFoundException('Unable to find Category entity.');

        $editForm = $this->createForm(new CategoryType(), $entity, array(
            'action' => $this->generateUrl('admin_edit_category', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $editForm->add('submit', 'submit', array('label' => 'Update'));

        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_edit_category', array('id' => $id)));
        }
        return $this->render('KnnfWhatsupBundle:Admin:editcategory.html.twig', array(
            'entity' => $entity,
            'form'   => $editForm->createView(),
        ));
    }

    public function addeventAction(Request $request)
    {
        $entity = new Event();

        $form = $this->createForm(new EventType(), $entity, array(
            'action' => $this->generateUrl('admin_add_event'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity->setActivate(1);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_edit_event', array('id' => $entity->getId())));
        }

        return $this->render('KnnfWhatsupBundle:Admin:addevent.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function addorganigrammeAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $organigrammes = $em->getRepository('KnnfWhatsupBundle:organigramme')->findAll();
        //die(var_dump($organigrammes));
         $entity = $em->getRepository('KnnfWhatsupBundle:Organigramme')->find(1);
         $form = $this->createForm(new OrganigrammeType(), $entity, array(
            'action' => $this->generateUrl('admin_add_organigramme', array('id' => 1)),
            'method' => 'PUT',
        ));
        $form->add('submit', 'submit', array('label' => 'Mettre à jour','attr' => array('class' => 'btn btn-default')));

        $form->handleRequest($request);
        if ($request->getMethod()=='PUT') {
            $data = $request->request->all();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_organigramme'));
        }

        return $this->render('KnnfWhatsupBundle:Admin:addorganigramme.html.twig', array(
            'organigrammes' => $organigrammes,
            'form' => $form->createView(),
        ));
    }
 
    public function editeventAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('KnnfWhatsupBundle:Event')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Event entity.');
        }

         $editForm = $this->createForm(new EventType(), $entity, array(
            'action' => $this->generateUrl('admin_edit_event', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $editForm->add('submit', 'submit', array('label' => 'Mettre à jour'));
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_edit_event', array('id' => $id)));
        }

        return $this->render('KnnfWhatsupBundle:Admin:editevent.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
        ));
    }

    public function editannotationAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('KnnfWhatsupBundle:Annotation')->find($id);

        if (!$entity) throw $this->createNotFoundException('Unable to find Annotation entity.');
        

        $editForm = $this->createForm(new AnnotationType(), $entity, array(
            'action' => $this->generateUrl('admin_edit_annotation', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $editForm->add('submit', 'submit', array('label' => 'Modifier'));

        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
          
            $em->flush();
            return $this->redirect($this->generateUrl('admin_edit_annotation', array('id' => $id,'entity' => $entity,)));
        }

        return $this->render('KnnfWhatsupBundle:Admin:editannotation.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'entity' => $entity,
        ));
    }





    public function articleAction()
    {
        $em = $this->getDoctrine()->getManager();
        $articles = $em->getRepository('KnnfWhatsupBundle:Article')->findAll();
        //$like = $em->getRepository('KnnfWhatsupBundle:Annotation')->findBy(array("idArticle"=>$data['article_id'],'AnnotationType' => 'like'));
        //$foo = count($like);
        return $this->render('KnnfWhatsupBundle:Admin:article.html.twig', array(
           'articles' => $articles,
           'count' => count($articles),
        ));
    }


    public function commentsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $comments = $em->getRepository('KnnfWhatsupBundle:Annotation')->findBy(array('AnnotationType' => 'comments'));
        
        return $this->render('KnnfWhatsupBundle:Admin:comments.html.twig', array(
           'comments' => $comments,
           'count' => count($comments),
        ));
    }

    public function userAction()
    {
		$em = $this->getDoctrine()->getManager();
		$users = $em->getRepository('KnnfWhatsupBundle:User')->findAll();
		
        return $this->render('KnnfWhatsupBundle:Admin:user.html.twig', array(
           'users' => $users,
           'count' => count($users),
        ));
    }

    public function categoryAction()
    {
		$em = $this->getDoctrine()->getManager();
		$categories = $em->getRepository('KnnfWhatsupBundle:Category')->findAll();
		
        return $this->render('KnnfWhatsupBundle:Admin:category.html.twig', array(
           'categories' => $categories,
           'count' => count($categories),
        ));
    }

    public function lookbookAction()
    {
		$em = $this->getDoctrine()->getManager();
		$lookbooks = $em->getRepository('KnnfWhatsupBundle:lookbook')->findAll();
		
        return $this->render('KnnfWhatsupBundle:Admin:lookbook.html.twig', array(
           'lookbooks' => $lookbooks,
           'count' => count($lookbooks),
        ));
    }

    public function eventAction()
    {
		$em = $this->getDoctrine()->getManager();
		$events = $em->getRepository('KnnfWhatsupBundle:Event')->findAll();
		
        return $this->render('KnnfWhatsupBundle:Admin:event.html.twig', array(
           'events' => $events,
           'count' => count($events),
        ));
    }

    public function organigrammeAction()
    {
        $em = $this->getDoctrine()->getManager();
        $organigramme = $em->getRepository('KnnfWhatsupBundle:organigramme')->findBy(array('id' => 1));
        
        return $this->render('KnnfWhatsupBundle:Admin:organigramme.html.twig', array(
           'organigramme' => $organigramme,
           'count' => count($organigramme),
        ));
    }

    public function signalementAction()
    {
        $em = $this->getDoctrine()->getManager();
        $signalements = $em->getRepository('KnnfWhatsupBundle:Annotation')->findBy(array('AnnotationType' => 'signalement'));
        return $this->render('KnnfWhatsupBundle:Admin:signalement.html.twig', array(
           'signalements' => $signalements,
           'count' => count($signalements),
        ));
    }

    public function annotationShowAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $annotation = $em->getRepository('KnnfWhatsupBundle:Annotation')->findBy(array('id' => $id));
        return $this->render('KnnfWhatsupBundle:Admin:annotationshow.html.twig', array(
           'annotation' => $annotation[0],
        ));
        
    }

     function to_slug($string){
        return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string)));
    }

}
