<?php

namespace Knnf\WhatsupBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Knnf\WhatsupBundle\Entity\Rights;
use Knnf\WhatsupBundle\Form\RightsType;

/**
 * Rights controller.
 *
 */
class RightsController extends Controller
{

    /**
     * Lists all Rights entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('KnnfWhatsupBundle:Rights')->findAll();

        return $this->render('KnnfWhatsupBundle:Rights:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Rights entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Rights();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('rights_show', array('id' => $entity->getId())));
        }

        return $this->render('KnnfWhatsupBundle:Rights:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Rights entity.
    *
    * @param Rights $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Rights $entity)
    {
        $form = $this->createForm(new RightsType(), $entity, array(
            'action' => $this->generateUrl('rights_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Rights entity.
     *
     */
    public function newAction()
    {
        $entity = new Rights();
        $form   = $this->createCreateForm($entity);

        return $this->render('KnnfWhatsupBundle:Rights:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Rights entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('KnnfWhatsupBundle:Rights')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Rights entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('KnnfWhatsupBundle:Rights:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Rights entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('KnnfWhatsupBundle:Rights')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Rights entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('KnnfWhatsupBundle:Rights:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Rights entity.
    *
    * @param Rights $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Rights $entity)
    {
        $form = $this->createForm(new RightsType(), $entity, array(
            'action' => $this->generateUrl('rights_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Rights entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('KnnfWhatsupBundle:Rights')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Rights entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('rights_edit', array('id' => $id)));
        }

        return $this->render('KnnfWhatsupBundle:Rights:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Rights entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('KnnfWhatsupBundle:Rights')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Rights entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('rights'));
    }

    /**
     * Creates a form to delete a Rights entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('rights_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
