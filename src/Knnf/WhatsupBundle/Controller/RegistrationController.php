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
            $form->bind($request);
    
            if ($form->isValid()) {
                $event = new FormEvent($form, $request);
                $dispatcher->dispatch(FOSUserEvents::REGISTRATION_SUCCESS, $event);
    
                $userManager->updateUser($user);
                if (null === $response = $event->getResponse()) {
                    $url = $this->container->get('router')->generate('fos_user_registration_confirmed');

                    /**send mail confirme
                    ini_set('SMTP','smtp.numericable.fr');
                    ini_set('sendmail_from','contact@whatsupmusic.fr');

                    $mail = 'nparamess@gmail.com'; // Déclaration de l'adresse de destination.
                    if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui rencontrent des bogues.
                    {
                        $passage_ligne = "\r\n";
                    }
                    else
                    {
                        $passage_ligne = "\n";
                    }

                    $message_html = "Bonjour,
                    Votre inscription sur le site whatsup est confirmé.
                    ";
                    $boundary = "-----=".md5(rand());

                    $sujet = "Inscription site whatsup confirmé";
                    $header = "From: \"Vincent Hacquard\"<nparamess@gmail.com>".$passage_ligne;
                    $header.= "Reply-to: \"WeaponsB\" <weaponsb@mail.fr>".$passage_ligne;
                    $header.= "MIME-Version: 1.0".$passage_ligne;
                    $header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
                    $message = $passage_ligne."--".$boundary.$passage_ligne;
                    $message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
                    $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
                    $message.= $passage_ligne.$message_html.$passage_ligne;

                    mail($mail,$sujet,$message,$header);
//==========*/
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