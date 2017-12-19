<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Contact;
use AppBundle\Form\ContactType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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
    public function addAction(Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush(); // Execute la requete

            $this->addFlash('success', 'Le contact a été créé');

            return $this->redirectToRoute('app_contact_list');
        }

        return $this->render('AppBundle:Contact:add.html.twig', array(
            'contactForm' => $form->createView(),
        ));
    }

    /**
     * @Route("/{id}")
     */
    public function showAction($id)
    {
        $repo = $this->get('doctrine')->getRepository(Contact::class);
        $monContact = $repo->findWithCompany($id);
        
        if (!$monContact) {
            throw $this->createNotFoundException('Contact not found!');
        }
        
        return $this->render('AppBundle:Contact:show.html.twig', array(
            'contact' => $monContact,
        ));
    }

    

}
