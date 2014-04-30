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

        return $this->render('KnnfWhatsupBundle:Category:list.html.twig', array(
            'categories' => $categories,
        ));
    }
  
    //Récupération de la liste des articles d'une catégories 
    public function showAction($slug, $page)
    {
        $maxArticles = 12;
        
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('KnnfWhatsupBundle:Category')->findOneBy(array('slug' => $slug));

        if (!$entity ) throw $this->createNotFoundException('Unable to find Category entity.');

        $articles_count = count($this->getDoctrine()
                ->getRepository("KnnfWhatsupBundle:Article")
                ->findBy(array("category"=> $entity->getId())));

        $pagination = array(
            'page' => $page,
            'route' => 'category_show',
            'pages_count' => ceil($articles_count / $maxArticles),
            'route_params' => array("slug"=>$slug)
        );

        $articles = $em->getRepository("KnnfWhatsupBundle:Article")->getList($page, $maxArticles, $entity);

        return $this->render('KnnfWhatsupBundle:Category:index.html.twig', array(
          'entity'=> $entity,
          'articles' => $articles,
          'pagination' => $pagination
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
