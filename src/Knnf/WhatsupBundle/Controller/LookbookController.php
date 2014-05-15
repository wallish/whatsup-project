<?php

namespace Knnf\WhatsupBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Knnf\WhatsupBundle\Entity\Lookbook;
use Knnf\WhatsupBundle\Form\LookbookType;
use Symfony\Component\HttpFoundation\Request;

/**
 * Lookbook controller.
 *
 */
class LookbookController extends Controller
{

    /**
     * Lists all Lookbook entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('KnnfWhatsupBundle:Lookbook')->findAll();

        return $this->render('KnnfWhatsupBundle:Lookbook:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Lookbook entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('KnnfWhatsupBundle:Lookbook')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Lookbook entity.');
        }

        return $this->render('KnnfWhatsupBundle:Lookbook:show.html.twig', array(
            'entity'      => $entity,
        ));
    }

    public function addAction(Request $request,$id=null)
    {
        $entity = new Lookbook();
        $form = $this->createForm(new LookbookType(), $entity, array(
            'action' => $this->generateUrl('lookbook_add'),
            'method' => 'POST',
        ));
            $em = $this->getDoctrine()->getManager();
        
        $form->add('submit', 'submit', array('label' => 'Publier','attr' => array('class' => 'btn btn-primary btn-sm')));
        $form->handleRequest($request);
        $user = $em->getRepository("KnnfWhatsupBundle:User")->findBy(array("id" => 2));
        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $user = $this->container->get('security.context')->getToken()->getUser();
            
            $entity->setUser($user);
            $entity->setActivate(0);
            $entity->upload();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('lookbook_show', array('id' => $entity->getId())));
        }

        return $this->render('KnnfWhatsupBundle:Lookbook:add.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'user'   => $user,
        ));
    }
}
