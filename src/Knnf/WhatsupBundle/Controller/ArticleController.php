<?php

namespace Knnf\WhatsupBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Knnf\WhatsupBundle\Entity\Category;
use Knnf\WhatsupBundle\Entity\Article;

class ArticleController extends Controller
{
    public function indexAction()
    {
        return $this->render('KnnfWhatsupBundle:Article:index.html.twig');
    }

    public function addAction(Request $request)
    {
        //if ($request->isMethod('POST')) {

            $article = new Article();
            $article->setTitle("poligondor");

            $category = new Category();
            $category->setName("Sport");
            $article->setCategory($category);

            $em = $this->getDoctrine()->getManager();

            $em->persist($category);
            $em->persist($article);
            $em->flush();
        //}

        return $this->render('KnnfWhatsupBundle:Article:add.html.twig');
    }

    public function editAction()
    {
        return $this->render('KnnfWhatsupBundle:Article:edit.html.twig');
    }

    public function deleteAction()
    {
    }

    public function activateAction()
    {
    }

}
