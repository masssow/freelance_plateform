<?php

namespace App\Controller;

use App\Entity\Freelance;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\FreelanceRegistrationFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class FreelanceRegisterController extends AbstractController
{
    #[Route('/inscription/freelance', name: 'app_freelance_register')]
    public function registerFreelance(Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $passwordEncoder): Response
    {
        $freelance = new Freelance();
        $form = $this->createForm(FreelanceRegistrationFormType::class, $freelance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $freelance->setPassword($passwordEncoder->hashPassword($freelance, $freelance->getPassword()));
            $freelance->setRoles(['ROLE_FREELANCE']);

            $em->persist($freelance);
            $em->flush();

            // return $this->redirectToRoute('freelance_dashboard');
        }

        return $this->render('freelance_register/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}
