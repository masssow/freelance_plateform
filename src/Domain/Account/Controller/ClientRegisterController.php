<?php

namespace App\Domain\Controller;

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
        EntityManagerInterface $em,
        UserPasswordHasherInterface $passwordHasher
    ): Response {
        $client = new Client();
        $form = $this->createForm(ClientRegistrationType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
                $client->setPassword($passwordHasher->hashPassword($client, $client->getPassword()));

            // $hashedPassword = $passwordHasher->hashPassword($client, $client->getPassword());
            // $client->setPassword($hashedPassword);

            $client->setRoles(['ROLE_CLIENT']);

            $em->persist($client);
            $em->flush();
            // dd($form);
             return $this->redirectToRoute('app_login');
             
        }
        return $this->render('account/client_register/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
