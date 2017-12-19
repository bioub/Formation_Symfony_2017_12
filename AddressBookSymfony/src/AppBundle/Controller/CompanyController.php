<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Company;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("/companies")
 */
class CompanyController extends Controller
{
    protected function getRepository() {
        return $this->getDoctrine()->getRepository(Company::class);
    }

    /**
     * @Route("/")
     */
    public function listAction()
    {
        $companies = $this->getRepository()->findBy([], ['name' => 'ASC'], 100);

        return $this->render('AppBundle:Company:list.html.twig', array(
            'companies' => $companies,
        ));
    }
    
    /**
     * @Route("/add")
     */
    public function addAction()
    {
        return $this->render('AppBundle:Company:add.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/{id}", requirements={"id"= "[1-9][0-9]*"} )
     */
    public function showAction($id)
    {
        $company = $this->getRepository()->find($id);

        if (!$company) {
            throw $this->createNotFoundException('Company not found');
        }

        return $this->render('AppBundle:Company:show.html.twig', array(
            'company' => $company,
        ));
    }

}
