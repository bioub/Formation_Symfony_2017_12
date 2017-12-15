<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Contact;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/contacts")
 */
class ContactController extends Controller
{
    /**
     * @Route("/")
     */
    public function listAction()
    {
        $repo = $this->getDoctrine()->getRepository(Contact::class);
        
        $contactsList = $repo->findAll();
        
        return $this->render('AppBundle:Contact:list.html.twig', array(
            'contacts' => $contactsList,
        ));
    }
    
    /**
     * @Route("/add")
     */
    public function addAction()
    {
        return $this->render('AppBundle:Contact:add.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/{id}")
     */
    public function showAction($id)
    {
        $repo = $this->getDoctrine()->getRepository(Contact::class);
        $monContact = $repo->find($id);
        
        if (!$monContact) {
            throw $this->createNotFoundException('Contact not found!');
        }
        
        return $this->render('AppBundle:Contact:show.html.twig', array(
            'contact' => $monContact,
        ));
    }

    

}
