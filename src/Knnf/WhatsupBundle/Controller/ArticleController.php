<?php

namespace Knnf\WhatsupBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Knnf\WhatsupBundle\Entity\Category;
use Knnf\WhatsupBundle\Entity\Article;

class ArticleController extends Controller
{
    protected function _getRepository(){
        return $this->getDoctrine()->getRepository('KnnfWhatsupBundle:Article');
    }

    public function indexAction()
    {
        //$article = $this->getDoctrine()->getRepository('KnnfWhatsupBundle:Article')->findAll();
        return $this->render('KnnfWhatsupBundle:Article:index.html.twig');
    }

    public function addAction(Request $request)
    {
       // $categories = $this->getDoctrine()->getRepository('KnnfWhatsupBundle:Category')->fetchPairs();

        /** FORM ARTICLE **/
        $form = $this->createFormBuilder()
            ->add('title', 'text')
            ->add('slug', 'text')
            ->add('content', 'text')
            ->add('picture', 'text')
            //->add('categorid', 'choice', array('choices' => $categories))
            ->add('categorid', 'entity', array('class' => 'KnnfWhatsupBundle:Category','property' => 'name'))
            ->add('valider', 'submit')
            ->getForm();

        if ($request->isMethod('POST')) {
            $data = $request->request->all();
            die(var_dump($data));

            $foo = $this->_getRepository()->save($data['form']);
        }
        return $this->render('KnnfWhatsupBundle:Article:add.html.twig',array('form' => $form->createView()));
    }

    public function editAction()
    {
        return $this->render('KnnfWhatsupBundle:Article:edit.html.twig');
    }

    // /article/delete/
    public function deleteAction(Request $request)
    {
        if ($request->isMethod('POST')) {
            $data = $request->request->all();
            $article = $this->_getRepository()->delete($data['id']);
            
        }

        return $this->render('KnnfWhatsupBundle:Article:delete.html.twig');

    }

    public function activateAction()
    {
    }

}
