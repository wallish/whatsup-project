<?php

namespace Knnf\WhatsupBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Knnf\WhatsupBundle\Entity\Annotation;
use Knnf\WhatsupBundle\Form\AnnotationType;

/**
 * Annotation controller.
 *
 */
class AnnotationController extends Controller
{

    /**
     * Lists all Annotation entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('KnnfWhatsupBundle:Annotation')->findAll();

        return $this->render('KnnfWhatsupBundle:Annotation:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Annotation entity.
     *
     */
    public function addAction(Request $request)
    {

        $entity = new Annotation();
        

        if ($request->isMethod('POST')) {
            $data = $request->request->all();

            //die(var_dump($data));

            $entity->setIdArticle($data['article_id']);
            $entity->setUser();
            $entity->setAnnotationType('signalement');
            $entity->setAnnotationContent($data['description']);

            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            die();
            return $this->redirect($this->generateUrl('annotation_show', array('id' => $entity->getId())));
        }

        return $this->render('KnnfWhatsupBundle:Annotation:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Annotation entity.
    *
    * @param Annotation $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Annotation $entity)
    {
        $form = $this->createForm(new AnnotationType(), $entity, array(
            'action' => $this->generateUrl('annotation_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Annotation entity.
     *
     */
    public function newAction()
    {
        $entity = new Annotation();
        $form   = $this->createCreateForm($entity);

        return $this->render('KnnfWhatsupBundle:Annotation:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Annotation entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('KnnfWhatsupBundle:Annotation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Annotation entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('KnnfWhatsupBundle:Annotation:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Annotation entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('KnnfWhatsupBundle:Annotation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Annotation entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('KnnfWhatsupBundle:Annotation:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Annotation entity.
    *
    * @param Annotation $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Annotation $entity)
    {
        $form = $this->createForm(new AnnotationType(), $entity, array(
            'action' => $this->generateUrl('annotation_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Annotation entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('KnnfWhatsupBundle:Annotation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Annotation entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('annotation_edit', array('id' => $id)));
        }

        return $this->render('KnnfWhatsupBundle:Annotation:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Annotation entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('KnnfWhatsupBundle:Annotation')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Annotation entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('annotation'));
    }

    /**
     * Creates a form to delete a Annotation entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('annotation_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
