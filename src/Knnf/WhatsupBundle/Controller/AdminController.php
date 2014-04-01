<?php

namespace Knnf\WhatsupBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Knnf\WhatsupBundle\Entity\Article;
use Knnf\WhatsupBundle\Entity\User;
use Knnf\WhatsupBundle\Entity\Category;
use Knnf\WhatsupBundle\Entity\Media;
use Knnf\WhatsupBundle\Entity\Event;
use Symfony\Component\HttpFoundation\Request;
use Knnf\WhatsupBundle\Form\UserType;


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
