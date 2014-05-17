<?php

namespace Knnf\WhatsupBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Knnf\WhatsupBundle\Entity\User;
use Knnf\WhatsupBundle\Form\UserType;
use Knnf\WhatsupBundle\Form\Type\RegistrationFormType;

/**
 * User controller.
 *
 */
class UserController extends Controller
{

    protected function _getRepository(){
        return $this->getDoctrine()->getRepository('KnnfWhatsupBundle:User');
    }

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entity = new User();
        $form = $this->createForm(new RegistrationFormType(), $entity, array(
            'action' => $this->generateUrl('admin_add_user'),
            'method' => 'POST',
        ));

        $entities = $em->getRepository('KnnfWhatsupBundle:User')->findAll();

        return $this->render('KnnfWhatsupBundle:User:index.html.twig', array(
            'entities' => $entities,
            'form' => $form,
        ));
    }
  
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('KnnfWhatsupBundle:User')->find($id);
        $user = $em->getRepository("KnnfWhatsupBundle:User")->findBy(array("id" => 2));
        $articles = $em->getRepository("KnnfWhatsupBundle:Article")->findBy(array("user" => $user),null,3);
        $nbarticles = $em->getRepository("KnnfWhatsupBundle:Article")->findBy(array("user" => $user));
        //$likes = $em->getRepository("KnnfWhatsupBundle:Annotation")->findBy(array("user" => $user));


        $query = $em->createQuery(
                'SELECT art, sum(art.views) as totalviews
                FROM KnnfWhatsupBundle:Article art
                WHERE art.user = :user
                ORDER BY art.views DESC'
            )->setParameters(array(
                'user' => $user
            ))->setMaxResults(1);
        $userview = $query->getSingleResult();
        if (!$entity)throw $this->createNotFoundException('Unable to find User entity.');

        return $this->render('KnnfWhatsupBundle:User:show.html.twig', array(
            'entity' => $entity,
            'articles' => $articles,
            'user' => $user,
            'nbarticles' => count($nbarticles),
            'totalviews' => $userview['totalviews']
        ));
    }

    public function adduserAction(Request $request)
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

    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('KnnfWhatsupBundle:User')->find($id);

        if (!$entity) throw $this->createNotFoundException('Unable to find User entity.');
        

        $editForm = $this->createForm(new UserType(), $entity, array(
            'action' => $this->generateUrl('user_edit', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $editForm->add('submit', 'submit', array('label' => 'Update'));

        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('user_edit', array('id' => $id)));
        }

        return $this->render('KnnfWhatsupBundle:User:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
        ));
    }



    public function activateAction(Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        if ($request->isMethod('POST')) {
            $data = $request->request->all();
            if(!$data['id']) die('Missing parameter');

            $entity = $em->getRepository('KnnfWhatsupBundle:User')->find($data['id']);

            if($entity->getActivate() == 1)
                $entity->setActivate(0);
            else
                $entity->setActivate(1);

            $em->persist($entity);
            $em->flush();
        }   
    }

    public function profilAction(){
        $em = $this->getDoctrine()->getManager();
        $articles = $em->getRepository('KnnfWhatsupBundle:Article')->findBy(array('userid' => $id));

        if (!$articles) throw $this->createNotFoundException('Unable to find Articles.');

        return $this->render('KnnfWhatsupBundle:User:profil.html.twig', array(
            'articles'      => $articles,
        ));
        
    }

    public function articleListAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $articles = $em->getRepository('KnnfWhatsupBundle:Article')->findBy(array('user' => $id,'activate' => 1));
        $user = $em->getRepository("KnnfWhatsupBundle:User")->findBy(array("id" => 2));


        return $this->render("KnnfWhatsupBundle:User:articlelist.html.twig", array(
            "articles"=>$articles,
            'user' => $user,
            
        ));
    }

    public function eventListAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository("KnnfWhatsupBundle:User")->findBy(array("id" => 2));

        $events = $em->getRepository('KnnfWhatsupBundle:Event')->findBy(array("id" => $id));
        return $this->render("KnnfWhatsupBundle:User:eventlist.html.twig", array(
            "events"=>$events,
            'user' => $user,
        ));
    }

    public function boardAction($id){
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('KnnfWhatsupBundle:User')->find($id);
        $user = $em->getRepository("KnnfWhatsupBundle:User")->findBy(array("id" => 2));
        $articles = $em->getRepository("KnnfWhatsupBundle:Article")->findBy(array("user" => $user),array('id'=>'DESC'),5);
        $events = $em->getRepository("KnnfWhatsupBundle:event")->findBy(array("user" => $user),array('id'=>'DESC'),5);
        $nbarticles = $em->getRepository("KnnfWhatsupBundle:Article")->findBy(array("user" => $user));
        //$likes = $em->getRepository("KnnfWhatsupBundle:Annotation")->findBy(array("user" => $user));


        $query = $em->createQuery(
                'SELECT art, sum(art.views) as totalviews
                FROM KnnfWhatsupBundle:Article art
                WHERE art.user = :user
                ORDER BY art.views DESC'
            )->setParameters(array(
                'user' => $user
            ))->setMaxResults(1);
        $userview = $query->getSingleResult();
        if (!$entity)throw $this->createNotFoundException('Unable to find User entity.');

        return $this->render('KnnfWhatsupBundle:User:board.html.twig', array(
            'entity' => $entity,
            'articles' => $articles,
            'user' => $user,
            'nbarticles' => count($nbarticles),
            'totalviews' => $userview['totalviews'],
            'events' => $events,
        ));
    }

    public function deleteAction(Request $request)
    {
        if ($request->isMethod('POST')) {
            $data = $request->request->all();
            if(!$data['id']) die('Missing parameter');
            $em = $this->getDoctrine()->getManager();
            $user = $em->getRepository('KnnfWhatsupBundle:User')->findBy(array('id' => $data['id']));
            $em->remove($user[0]);
            $em->flush();
            die();
        }

        return $this->render('KnnfWhatsupBundle:User:delete.html.twig');
        //return true;

    }

    public function settingAction()
    {
        $em = $this->getDoctrine()->getManager();
        //$user = $em->getRepository("KnnfWhatsupBundle:User")->findBy(array("id" => 2));
        $user = $this->container->get('security.context')->getToken()->getUser();

        $events = $em->getRepository('KnnfWhatsupBundle:Event')->findBy(array("id" => $id));
        return $this->render("KnnfWhatsupBundle:User:setting.html.twig", array(
            "events"=>$events,
            'user' => $user,
        ));
    }

    public function unsubscribeAction()
    {
        $em = $this->getDoctrine()->getManager();
        //$user = $em->getRepository("KnnfWhatsupBundle:User")->findBy(array("id" => 2));
        $user = $this->container->get('security.context')->getToken()->getUser();

        $events = $em->getRepository('KnnfWhatsupBundle:Event')->findBy(array("id" => $id));
        return $this->render("KnnfWhatsupBundle:User:unsubscribe.html.twig", array(
            "events"=>$events,
            'user' => $user,
        ));
    }

    public function loginAction(){
        $entity = new User();

        $registrationForm = $this->createForm(new RegistrationFormType(), $entity, array(
            'action' => $this->generateUrl('admin_add_user'),
            'method' => 'POST',
        ));
        return $this->render('KnnfWhatsupBundle:User:login.html.twig', array(
            'form' => $registrationForm,
        ));
    }

    public function registerAction(){
        
    }
 
}
