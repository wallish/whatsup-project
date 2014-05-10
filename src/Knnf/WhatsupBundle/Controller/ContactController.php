<?php

namespace Knnf\WhatsupBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends Controller
{
    public function indexAction(Request $request)
    {
    	$em = $this->getDoctrine()->getManager();
       
        if ($request->getMethod()=='POST') {
            $data = $request->request->all();
            $message = \Swift_Message::newInstance()
			        ->setSubject($data['nom'])
			        ->setFrom($data['email'])
			        ->setTo('nparamess@gmail.com')
			        ->setBody($data['message']);
			 $this->get('mailer')->send($message);	


        }
        return $this->render('KnnfWhatsupBundle:Contact:index.html.twig', array(
        ));
    }

}
