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

    protected function _getRepository(){
        return $this->getDoctrine()->getRepository('KnnfWhatsupBundle:Category');
    }

    //Affichage de la liste des catégories, lors d'un clic sur le menu 'Catégories'
    public function indexAction($slug)
    {
        //echo $slug;
        $em = $this->getDoctrine()->getManager();

        $categories = $em->getRepository('KnnfWhatsupBundle:Category')->findAll();
        $events = $em->getRepository('KnnfWhatsupBundle:Event')->findAll();

        return $this->render('KnnfWhatsupBundle:Category:list.html.twig', array(
            'categories' => $categories,
            'events' => $events,

        ));
    }
  
    //Récupération de la liste des articles d'une catégories 
    public function showAction($slug)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('KnnfWhatsupBundle:Category')->findOneBy(array('slug' => $slug));
        $events = $em->getRepository('KnnfWhatsupBundle:Event')->findAll();

        if (!$entity ) throw $this->createNotFoundException('Unable to find Category entity.');

        $articles = $em->getRepository("KnnfWhatsupBundle:Article")->findBy(array("category"=> $entity->getId()));

        
        return $this->render(($slug != "mode") ? 'KnnfWhatsupBundle:Category:index.html.twig' : 'KnnfWhatsupBundle:Category:gallery.html.twig', array(
          'entity'=> $entity,
          'articles' => $articles,
          'events' => $events,

        ));
    }
    
    //Ajout d'une catégorie
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

    //Edition d'une catégorie
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

    //Suppression d'une catégorie
    public function deleteAction(Request $request)
    {
        if ($request->isMethod('POST')) {
            $data = $request->request->all();
            if(!$data['id']) die('Missing parameter');
            /*$em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('KnnfWhatsupBundle:Article')->find($data['id']);*/
            $article = $this->_getRepository()->delete($data['id']);
        }

        return $this->render('KnnfWhatsupBundle:Category:delete.html.twig');
        //return true;

    }

}
