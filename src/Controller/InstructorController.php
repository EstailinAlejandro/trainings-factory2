<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InstructorController extends AbstractController
{
    #[Route('/instructor', name: 'app_instructor')]
    public function index(): Response
    {
        return $this->render('instructor/index.html.twig', [
            'controller_name' => 'InstructorController',
        ]);
    }

    #[Route('/contactinstructor', name: 'app_contact_instructor')]
    public function contact(): Response
    {

        return $this->render('instructor/contact.html.twig', [
            'controller_name' => 'FactoryController',

        ]);
    }
}
