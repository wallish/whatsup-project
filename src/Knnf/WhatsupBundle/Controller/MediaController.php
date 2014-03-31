<?php

namespace Knnf\WhatsupBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Knnf\WhatsupBundle\Entity\Media;
use Knnf\WhatsupBundle\Form\MediaType;

/**
 * Media controller.
 *
 */
class MediaController extends Controller
{

    /**
     * Lists all Media entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('KnnfWhatsupBundle:Media')->findAll();

        return $this->render('KnnfWhatsupBundle:Media:index.html.twig', array(
            'entities' => $entities
        ));
    }

    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('KnnfWhatsupBundle:Media')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Media entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('KnnfWhatsupBundle:Media:show.html.twig', array(
            'entity'      => $entity));
    }

    public function addAction(Request $request)
    {
        $entity = new Media();


        $form = $this->createForm(new MediaType(), $entity, array(
            'action' => $this->generateUrl('media_add'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('media_add', array('id' => $entity->getId())));
        }

        return $this->render('KnnfWhatsupBundle:Media:add.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

  

    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('KnnfWhatsupBundle:Media')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Media entity.');
        }

        $editFor = $this->createForm(new MediaType(), $entity, array(
            'action' => $this->generateUrl('media_edit', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $editForm->add('submit', 'submit', array('label' => 'Update'));

        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('media_edit', array('id' => $id)));
        }

        return $this->render('KnnfWhatsupBundle:Media:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }

    public function deleteAction(Request $request)
    {
        if ($request->isMethod('POST')) {
            $data = $request->request->all();
            if(!$data['id']) die('Missing parameter');
            /*$em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('KnnfWhatsupBundle:Article')->find($data['id']);*/
            $article = $this->_getRepository()->delete($data['id']);
        }

        return $this->render('KnnfWhatsupBundle:Media:delete.html.twig');
        //return true;

    }
 
}
