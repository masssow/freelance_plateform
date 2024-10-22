<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class FreelanceDashboardController extends AbstractController
{
    #[Route('/freelance/dashboard', name: 'app_freelance_dashboard')]
    public function index(): Response
    {
        return $this->render('freelance_dashboard/index.html.twig', [
            'controller_name' => 'FreelanceDashboardController',
        ]);
    }
}
