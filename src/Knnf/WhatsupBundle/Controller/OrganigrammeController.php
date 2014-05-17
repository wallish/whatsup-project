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

        $organigramme = $em->getRepository('KnnfWhatsupBundle:organigramme')->findBy(array('id' => 1));
        $user = $em->getRepository('KnnfWhatsupBundle:user')->findBy(array('id' => 2));

        return $this->render('KnnfWhatsupBundle:Organigramme:index.html.twig', array(
            'organigramme' => $organigramme,
            'user' => $user
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
