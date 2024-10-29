<?php

namespace App\Domain\Account\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ClientDashboardController extends AbstractController
{
    private Security $security;

    public function __construct(Security $security) {
        $this->security = $security;
    }

    #[Route('/client/dashboard', name: 'app_client_dashboard')]
    public function index(): Response
    {
        $client = $this->getUser();

        if (!$client instanceof \App\Entity\Client) {
            throw $this->createAccessDeniedException('Accès réservé aux clients.');
        }

        return $this->render('account/client_dashboard/index.html.twig', [
            'client' => $client,
        ]);
    }
}
