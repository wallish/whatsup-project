<?php

namespace Knnf\WhatsupBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Knnf\WhatsupBundle\Entity\Organigramme;

/**
 * Organigramme controller.
 *
 */
class OrganigrammeController extends Controller
{

    /**
     * Lists all Organigramme entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('KnnfWhatsupBundle:Organigramme')->findAll();

        return $this->render('KnnfWhatsupBundle:Organigramme:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Organigramme entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('KnnfWhatsupBundle:Organigramme')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Organigramme entity.');
        }

        return $this->render('KnnfWhatsupBundle:Organigramme:show.html.twig', array(
            'entity'      => $entity,
        ));
    }
}
