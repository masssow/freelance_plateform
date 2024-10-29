<?php

namespace App\Domain\Account\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class FreelanceDashboardController extends AbstractController
{
    #[Route('/freelance/dashboard', name: 'app_freelance_dashboard')]
    public function index(): Response
    {
        $user = $this->getUser();
        return $this->render('account/freelance_dashboard/index.html.twig', [
            $user => 'user',
        ]);
    }
}
