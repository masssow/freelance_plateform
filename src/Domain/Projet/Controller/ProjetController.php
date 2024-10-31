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
use Symfony\Component\Security\Http\Attribute\IsGranted;


class ProjetController extends AbstractController
{
    public function __construct(private ProjetService $projetService)
    {}

    #[Route('/projet', name: 'app_projet')]
    public function index(ClientRepository $clientRepository): Response
    {
        $client = $this->getUser();
        $projets = $client->getProjetsPublies();
        
        return $this->render('projet/index.html.twig', [
            'projets' => $projets,
            'client' => $client
        ]);
    }

    #[Route('/projet/publier/{id}', name: 'app_project_publish', methods: ['POST'])]
    #[IsGranted('ROLE_CLIENT')]
    public function publish(Projet $projet, EntityManagerInterface $entityManager): RedirectResponse
    {
        if($projet->getClientCreateur() !== $this->getUser()){
        $this->addFlash('error','Vous ne pouvez pas publier ce projet.');
            return $this->redirectToRoute('app_client_dashboard');
        }

        $projet->setStatus(Projet::STATUS_PUBLISHED);
        $entityManager->flush();

         $this->addFlash('succes', 'Votre projet a été publié avec succès.');
        
        return $this->redirectToRoute('app_client_dashboard');

    }
    
    #[Route('/projets', name: 'app_projets_liste')]
    public function listeProjets(): Response
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

    #[Route('/editer-projet/{id}', name: 'app_edit_projet', methods: ['GET', 'POST'])]
    public function edit(Request $request, Projet $projet, EntityManagerInterface $entityManager): Response
    {

        if (!$projet) {
            $this->addFlash('error', 'Projet non trouvé.');
            return $this->redirectToRoute('app_projets_list');
        }

        $form = $this->createForm(ProjetType::class, $projet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->projetService->updateProjet($projet);
            $entityManager->flush();

            $this->addFlash('success', 'Projet mis à jour.');
            return $this->redirectToRoute('app_projets_liste'); 
        }

        return $this->render('projet/edit.html.twig', [
            'form' => $form->createView(),
            'projet' => $projet,
        ]);
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

    #[Route('/{id}/details-de-projet', name: 'app_projet_detail')]
    public function projetDetail(Projet $projet, EntityManagerInterface $entityManager, $id): Response
    {
        $projet = $entityManager->getRepository(Projet::class)->find($id);

        // return $this->redirectToRoute('client_projet_liste');

        return $this->render('projet/projet_detail.html.twig', [
            'projet' => $projet,
        ]);
    }

}
