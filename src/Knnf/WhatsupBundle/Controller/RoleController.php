<?php

namespace Knnf\WhatsupBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Knnf\WhatsupBundle\Entity\Role;
use Knnf\WhatsupBundle\Entity\Category;
use Knnf\WhatsupBundle\Entity\Rights;
use Knnf\WhatsupBundle\Form\RoleType;

/**
 * Role controller.
 *
 */
class RoleController extends Controller
{
    protected function _getRepository(){
        return $this->getDoctrine()->getRepository('KnnfWhatsupBundle:Role');
    }

    /**
     * Lists all Role entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('KnnfWhatsupBundle:Role')->findAll();

        return $this->render('KnnfWhatsupBundle:Role:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Role entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Role();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
           $foo = $form->getdata();
            $em = $this->getDoctrine()->getManager();
            $entity->setRights(json_encode(($foo->getRights())));
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('role'));
        }

        return $this->render('KnnfWhatsupBundle:Role:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Role entity.
    *
    * @param Role $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Role $entity)
    {
        $em = $this->getDoctrine()->getManager();
        $rights = $em->getRepository('KnnfWhatsupBundle:Rights')->fetchPairs();
        $form = $this->createForm(new RoleType($rights), $entity, array(
            'action' => $this->generateUrl('role_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Créer','attr' => array('class' => 'btn btn-primary')));

        return $form;
    }

    /**
     * Displays a form to create a new Role entity.
     *
     */
    public function newAction()
    {
        $entity = new Role();
        $form   = $this->createCreateForm($entity);

        return $this->render('KnnfWhatsupBundle:Role:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Role entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('KnnfWhatsupBundle:Role')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Role entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('KnnfWhatsupBundle:Role:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Role entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('KnnfWhatsupBundle:Role')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Role entity.');
        }
        $entity->setRights(json_decode($entity->getRights()));

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('KnnfWhatsupBundle:Role:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Role entity.
    *
    * @param Role $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Role $entity)
    {
         $em = $this->getDoctrine()->getManager();
        $rights = $em->getRepository('KnnfWhatsupBundle:Rights')->fetchPairs();
        $form = $this->createForm(new RoleType($rights), $entity, array(
            'action' => $this->generateUrl('role_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Modifier','attr' => array('class' => 'btn btn-warning')));

        return $form;
    }
    /**
     * Edits an existing Role entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('KnnfWhatsupBundle:Role')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Role entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $entity->setRights(json_decode(($entity->getRights())));
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
        //die(var_dump(($entity->getRights())));

            $entity->setRights(json_encode($entity->getRights()));
            $em->flush();

            return $this->redirect($this->generateUrl('role_edit', array('id' => $id)));
        }

        return $this->render('KnnfWhatsupBundle:Role:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Role entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('KnnfWhatsupBundle:Role')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Role entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('role'));
    }

    /**
     * Creates a form to delete a Role entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('role_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Supprimer','attr' => array('class' => 'btn btn-danger')))
            ->getForm()
        ;
    }


       //Suppression d'une catégorie
    public function delete2Action(Request $request)
    {
        if ($request->isMethod('POST')) {
            $data = $request->request->all();
            if(!$data['id']) die('Missing parameter');
            /*$em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('KnnfWhatsupBundle:Article')->find($data['id']);*/
            $article = $this->_getRepository()->delete($data['id']);
        }

        return $this->render('KnnfWhatsupBundle:Role:delete.html.twig');
        //return true;

    }
}
