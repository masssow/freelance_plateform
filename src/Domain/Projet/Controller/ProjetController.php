<?php

namespace App\Domain\Projet\Controller;

use App\Entity\Client;
use App\Entity\Projet;
use App\Repository\ClientRepository;
use App\Domain\Projet\Form\ProjetType;
use Doctrine\ORM\EntityManagerInterface;
use App\Domain\Projet\Service\ProjetService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProjetController extends AbstractController
{
    public function __construct(private ProjetService $projetService)
    {}
    
    #[Route('/projets', name: 'app_projets_liste')]
    public function listeProjets(ClientRepository $clientRepository): Response
    {
        
        $client = $this->getUser();
        $projets = $client->getProjetsPublies();
        
        // dd(get_class($client));

        return $this->render('projet/liste_projets.html.twig', [
            'projets' => $projets,
            'client' => $client
        ]);
    }

    #[Route('/creer-projet', name: 'app_new_projet')]
    public function newProjet(Request $request): Response
    {
            $projet = new Projet();
            $form = $this->createForm(ProjetType::class, $projet);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
            $client = $this->getUser();
            $this->projetService->createProjet($this->getUser(), $projet);
            $this->addFlash('success', 'Projet créé avec succès.');
            return $this->redirectToRoute('app_projets_liste');
            }

        return $this->render('projet/new.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/{id}/editer-projet', name: 'app_edit_projet')]
    public function edit(Request $request, Projet $projet): Response
    {
        $form = $this->createForm(ProjetType::class, $projet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->projetService->updateProjet($projet);
            $this->addFlash('success', 'Projet mis à jour.');
            return $this->redirectToRoute('client_projet_liste');

        return $this->render('projet/edit.html.twig', [
                'form' => $form->createView(),
                'projet' => $projet        ]);
            }
    }

    #[Route('/projet/supprimet/{id}', name: 'delete_project', methods: ['POST'])]
    public function deleteProjet(int $id, Request $request, EntityManagerInterface $entityManager): RedirectResponse
    {
        // Chargement du projet
        $projet = $entityManager->getRepository(Projet::class)->find($id);

        if (!$projet) {
            $this->addFlash('error', 'Projet non trouvé.');
            return $this->redirectToRoute('project_list'); // Redirige vers la liste des projets
        }

        // Vérification du jeton CSRF
        if (!$this->isCsrfTokenValid('delete-project-' . $id, $request->request->get('_token'))) {
            $this->addFlash('error', 'Échec de la validation CSRF.');
            return $this->redirectToRoute('project_list');
        }

        // Suppression du projet
        $entityManager->remove($projet);
        $entityManager->flush();

        // Message de succès
        $this->addFlash('success', 'Projet supprimé avec succès.');

        return $this->redirectToRoute('project_list'); // Redirige vers la liste des projets
    }


    #[Route('/status-projet', name: 'app_statut')]
    public function Statut(Projet $projet, string $status): Response
    {
        $this->projetService->changeStatus($projet, $status);
        $this->addFlash('success', 'Statut du projet mis à jour.');

        return $this->redirectToRoute('client_projet_liste');

        return $this->render('projet/index.html.twig', [
            'controller_name' => 'ProjetController',
        ]);
    }

    #[Route('/{id}/status-projet', name: 'app_update_statut')]
    public function changeStatut(Projet $projet, string $status): Response
    {
        $this->projetService->changeStatus($projet, $status);
        $this->addFlash('success', 'Statut du projet mis à jour.');

        return $this->redirectToRoute('client_projet_liste');

        return $this->render('projet/edit.html.twig', [
            'controller_name' => 'ProjetController',
        ]);
    }

}
