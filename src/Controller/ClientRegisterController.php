<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\ClientRegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ClientRegisterController extends AbstractController
{
    #[Route('/inscription/client', name: 'app_client_register')]
    public function registerClient(
        Request $request,
        EntityManagerInterface $entityManager,
        UserPasswordHasherInterface $passwordHasher
    ): Response {
        $client = new Client();
        $form = $this->createForm(ClientRegistrationType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hashedPassword = $passwordHasher->hashPassword($client, $client->getPassword());
            $client->setPassword($hashedPassword);

            $client->setRoles(['ROLE_CLIENT']);

            $entityManager->persist($client);
            $entityManager->flush();

            // return $this->redirectToRoute('client_dashboard');
        }
        return $this->render('client_register/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
