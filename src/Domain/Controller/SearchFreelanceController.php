<?php

namespace App\Domain\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SearchFreelanceController extends AbstractController
{
    #[Route('/search/freelance', name: 'app_search_freelance')]
    public function index(): Response
    {
        return $this->render('search_freelance/index.html.twig', [
            'controller_name' => 'SearchFreelanceController',
        ]);
    }
}
