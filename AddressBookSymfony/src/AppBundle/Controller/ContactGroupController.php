<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ContactGroup;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Contactgroup controller.
 *
 * @Route("groups")
 */
class ContactGroupController extends Controller
{
    /**
     * Lists all contactGroup entities.
     *
     * @Route("/", name="groups_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $contactGroups = $em->getRepository('AppBundle:ContactGroup')->findAll();

        return $this->render('contactgroup/index.html.twig', array(
            'contactGroups' => $contactGroups,
        ));
    }

    /**
     * Finds and displays a contactGroup entity.
     *
     * @Route("/{id}", name="groups_show")
     * @Method("GET")
     */
    public function showAction(ContactGroup $contactGroup)
    {

        return $this->render('contactgroup/show.html.twig', array(
            'contactGroup' => $contactGroup,
        ));
    }
}
