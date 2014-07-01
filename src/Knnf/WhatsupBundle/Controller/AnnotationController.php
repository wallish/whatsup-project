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
        $em = $this->getDoctrine()->getManager();
        

        if ($request->isMethod('POST')) {
            $data = $request->request->all();

            //die(var_dump($data));

            $article = $em->getRepository('KnnfWhatsupBundle:Article')->findBy(array('id' => $data['article_id']));

            $entity->setIdArticle($data['article_id']);
            $user = $this->container->get('security.context')->getToken()->getUser();
            $entity->setUser($user);

            $entity->setArticle($article[0]);
            $entity->setAnnotationType($data['type']);
            $entity->setAnnotationContent($data['description']);
            if(isset($data['raison']) && $data['raison'] != "")
                $entity->setAnnotationRaison($data['raison']);
    

            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            if($data['type']=="like"){
                $like = $em->getRepository('KnnfWhatsupBundle:Annotation')->findBy(array("idArticle"=>$data['article_id'],'AnnotationType' => 'like'));
                $foo = count($like);
                echo $foo;
            }else if($data['type']=="comments"){
                $comments = $em->getRepository('KnnfWhatsupBundle:Annotation')->findBy(array("idArticle"=>$data['article_id'],'AnnotationType' => 'comments'));
                $nbcomments = count($comments);
                echo $nbcomments;
            }
            die();
            //return $this->redirect($this->generateUrl('annotation_show', array('id' => $entity->getId())));
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
            'delete_form' => $deleteForm->createView(),
        ));
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
    public function deleteAction(Request $request)
    {
        if ($request->isMethod('POST')) {
            $data = $request->request->all();
            if(!$data['id']) die('Missing parameter');
            $em = $this->getDoctrine()->getManager();
            $articles = $em->getRepository('KnnfWhatsupBundle:Annotation')->findBy(array('id' => $data['id']));
            $em->remove($articles[0]);
            $em->flush();
        }

        return $this->render('KnnfWhatsupBundle:Article:delete.html.twig');
        //return true;

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

    public function activateAction(Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        if ($request->isMethod('POST')) {
            $data = $request->request->all();
            if(!$data['id']) die('Missing parameter');

            $entity = $em->getRepository('KnnfWhatsupBundle:Annotation')->find($data['id']);

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
