<?php

namespace Knnf\WhatsupBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Knnf\WhatsupBundle\Entity\Event;
use Knnf\WhatsupBundle\Form\EventType;

/**
 * Event controller.
 *
 */
class EventController extends Controller
{

    /**
     * Lists all Event entities.
     *
     */
    protected function _getRepository(){
        return $this->getDoctrine()->getRepository('KnnfWhatsupBundle:Event');
    }

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('KnnfWhatsupBundle:Event')->findAll();
        $user = $em->getRepository("KnnfWhatsupBundle:User")->findBy(array("id" => 2));

        return $this->render('KnnfWhatsupBundle:Event:index.html.twig', array(
            'entities' => $entities,
            'user' => $user,
        ));
    }
  
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('KnnfWhatsupBundle:Event')->find($id);
        $user = $em->getRepository("KnnfWhatsupBundle:User")->findBy(array("id" => 2));

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Event entity.');
        }

       // $deleteForm = $this->createDeleteForm($id);

        return $this->render('KnnfWhatsupBundle:Event:show.html.twig', array(
            'entity'      => $entity,
            'user' => $user

            ));
    }

 
    public function addAction(Request $request)
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        $this->checkAcl($user,'event_add');

        $entity = new Event();

        $form = $this->createForm(new EventType(), $entity, array(
            'action' => $this->generateUrl('event_add'),
            'method' => 'POST',
        ));
            $em = $this->getDoctrine()->getManager();
        

        $form->add('submit', 'submit', array('label' => 'Soumettre','attr' => array('class' => 'btn btn-primary btn-sm')));
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $user = $this->container->get('security.context')->getToken()->getUser();
            $entity->setUser($user);
            $entity->setActivate(0);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('event_show', array('id' => $entity->getId())));
        }

        return $this->render('KnnfWhatsupBundle:Event:add.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'user' => $user,
        ));
    }


    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('KnnfWhatsupBundle:Event')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Event entity.');
        }

         $editForm = $this->createForm(new EventType(), $entity, array(
            'action' => $this->generateUrl('event_edit', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $editForm->add('submit', 'submit', array('label' => 'Mettre à jour','attr' => array('class' => 'btn btn-warning btn-sm')));
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('event_edit', array('id' => $id)));
        }

        return $this->render('KnnfWhatsupBundle:Event:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
        ));
    }

    public function deleteAction(Request $request)
    {
        if ($request->isMethod('POST')) {
            $data = $request->request->all();
            if(!$data['id']) die('Missing parameter');
            $em = $this->getDoctrine()->getManager();
            $event = $em->getRepository('KnnfWhatsupBundle:Event')->findBy(array('id' => $data['id']));
            $em->remove($event[0]);
            $em->flush();
        }

        return $this->render('KnnfWhatsupBundle:Event:delete.html.twig');
        //return true;

    }

    public function activateAction(Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        if ($request->isMethod('POST')) {
            $data = $request->request->all();
            if(!$data['id']) die('Missing parameter');

            $entity = $em->getRepository('KnnfWhatsupBundle:Event')->find($data['id']);

            if($entity->getActivate() == 1)
                $entity->setActivate(0);
            else
                $entity->setActivate(1);

            $em->persist($entity);
            $em->flush();
            die();
            
        }   
    }

     public function checkAcl($user = null,$name=null)
    {
        if(!$name) die('Missing role name');

        $em = $this->getDoctrine()->getManager();
        $role = $em->getRepository('KnnfWhatsupBundle:Role')->findBy(array('id' => ($user!= "anon.") ? $user->getRole():1));
        $action = $em->getRepository('KnnfWhatsupBundle:Rights')->findBy(array('name' => $name));

        $userRights = json_decode($role[0]->getRights());

        if(!in_array($action[0]->getId(), $userRights)) die('Access denied');
            
        /*}else{
            $role = $em->getRepository('KnnfWhatsupBundle:Role')->findBy(array('id' => $user->getRole()));
            $action = $em->getRepository('KnnfWhatsupBundle:Rights')->findBy(array('name' => $name));
            
            $userRights = json_decode($role->getRights());
            
            if(!in_array($action->getId(), $userRights)){
                 // redirect
                 die('Access denied');
             }
        }*/
            
        
    }
  
}
