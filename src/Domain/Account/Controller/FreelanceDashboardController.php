<?php

namespace App\Domain\Account\Controller;

use App\Repository\ProjetRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Domain\Projet\Form\ProjetSearchFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FreelanceDashboardController extends AbstractController
{
    #[Route('/freelance/dashboard', name: 'app_freelance_dashboard')]
    public function index(): Response
    {
        $user = $this->getUser();
        return $this->render('account/freelance_dashboard/index.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/freelance/projets', name: 'app_freelance_search_projects')]
    public function searchProjects(Request $request, ProjetRepository $projetRepository): Response
    {
        $form = $this->createForm(ProjetSearchFormType::class);
        $form->handleRequest($request);

        $projets = [];

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $projets = $projetRepository->searchProjects(
                $data['titre'] ?? null,
                $data['competence'] ?? null,
                $data['budgetMax'] ?? null,
                $data['nomEntreprise'] ?? null
            );
        }

        return $this->render('account/freelance_dashboard/search_projet.html.twig', [
            'form' => $form->createView(),
            'projets' => $projets,
        ]);
    }
}
