<?php

namespace Knnf\WhatsupBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Knnf\WhatsupBundle\Entity\Category;
use Knnf\WhatsupBundle\Form\CategoryType;

/**
 * Category controller.
 *
 */
class CategoryController extends Controller
{


    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('KnnfWhatsupBundle:Category')->findAll();

        return $this->render('KnnfWhatsupBundle:Category:index.html.twig', array(
            'entities' => $entities,
        ));
    }
  
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('KnnfWhatsupBundle:Category')->find($id);

        if (!$entity) throw $this->createNotFoundException('Unable to find Category entity.');

        return $this->render('KnnfWhatsupBundle:Category:show.html.twig', array(
            'entity'      => $entity));
    }
    
    public function addAction(Request $request)
    {
        $entity = new Category();

        $form = $this->createForm(new CategoryType(), $entity, array(
            'action' => $this->generateUrl('category_add'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('category_show', array('id' => $entity->getId())));
        }

        return $this->render('KnnfWhatsupBundle:Category:add.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }


 

    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('KnnfWhatsupBundle:Category')->find($id);

        if (!$entity) throw $this->createNotFoundException('Unable to find Category entity.');

        $editForm = $this->createForm(new CategoryType(), $entity, array(
            'action' => $this->generateUrl('category_edit', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $editForm->add('submit', 'submit', array('label' => 'Update'));

        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('category_edit', array('id' => $id)));
        }

        return $this->render('KnnfWhatsupBundle:Category:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }

}
