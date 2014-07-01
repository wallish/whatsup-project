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

        $entities = $em->getRepository('KnnfWhatsupBundle:Lookbook')->findBy(array('activate' => 1));

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
        $user = $em->getRepository('KnnfWhatsupBundle:User')->findBy(array('id' => $entity->getUser()->getId()));
        $lookbook = $em->getRepository("KnnfWhatsupBundle:Lookbook")->findBy(array("user" => $user),array('dateinsert' => 'desc'));
        $nbarticles = $em->getRepository("KnnfWhatsupBundle:Article")->findBy(array("user" => $user));
        //$likes = $em->getRepository("KnnfWhatsupBundle:Annotation")->findBy(array("user" => $user));
        $likes = $em->getRepository('KnnfWhatsupBundle:Annotation')->getBestUserOfTheMonth2(array('id' => $entity->getUser()->getId()));
        $comment = $em->getRepository('KnnfWhatsupBundle:Annotation')->getComment(array('id' => $entity->getUser()->getId()));
       /* $userlikes = $em->getRepository('KnnfWhatsupBundle:Annotation')->findBy(array('AnnotationType' => 'like','user' => $entity->getUser()));
        die(count($userlikes));*/
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Lookbook entity.');
        }
        return $this->render('KnnfWhatsupBundle:Lookbook:show.html.twig', array(
            'entity'      => $entity,
            'user' => $user[0],
            'nbarticles' => count($nbarticles),
            'like' => $likes[0]['nombre'],
            'comment' => $comment[0]['nombre']

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
            $entity->setActivate(1);
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
