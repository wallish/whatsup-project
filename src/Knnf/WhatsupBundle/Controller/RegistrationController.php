<?php

namespace Knnf\WhatsupBundle\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use FOS\UserBundle\Controller\RegistrationController as BaseController;
use Symfony\Component\HttpFoundation\Request;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\UserEvent;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use Knnf\WhatsupBundle\Entity\User;
use Knnf\WhatsupBundle\Entity\Role;


class RegistrationController extends BaseController
{
   public function registerAction(Request $request)
    {
        /** @var $formFactory \FOS\UserBundle\Form\Factory\FactoryInterface */
        $formFactory = $this->container->get('fos_user.registration.form.factory');
        /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
        $userManager = $this->container->get('fos_user.user_manager');
        /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
        $dispatcher = $this->container->get('event_dispatcher');
    
        $user = $userManager->createUser();
        $user->setEnabled(true);
    
        $dispatcher->dispatch(FOSUserEvents::REGISTRATION_INITIALIZE, new UserEvent($user, $request));
    
        $form = $formFactory->createForm();
        $form->setData($user);
    
        if ('POST' === $request->getMethod()) {
            $foo = $form->getData();
            $form->bind($request);
            if ($form->isValid()) {

                $event = new FormEvent($form, $request);
                $dispatcher->dispatch(FOSUserEvents::REGISTRATION_SUCCESS, $event);
                $user->upload();
                  $em = $this->getDoctrine()->getManager();
                    $role = $em->getRepository("KnnfWhatsupBundle:Role")->findBy(array("id" => 2));
                $user->setRole($role[0]);
                $userManager->updateUser($user);
                if (null === $response = $event->getResponse()) {
                    $url = $this->container->get('router')->generate('fos_user_registration_confirmed');

                    $response = new RedirectResponse($url);
                }
    
                $dispatcher->dispatch(FOSUserEvents::REGISTRATION_COMPLETED, new FilterUserResponseEvent($user, $request, $response));
    
                return $response;
            }
        }
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository("KnnfWhatsupBundle:User")->findBy(array("id" => 2));
        
        return $this->container->get('templating')->renderResponse('KnnfWhatsupBundle:Registration:register.html.'.$this->getEngine(), array(
                'form' => $form->createView(),
                'user' => $user,
        ));
    }


    public function getDoctrine()
{
    return $this->container->get('doctrine');
}
}