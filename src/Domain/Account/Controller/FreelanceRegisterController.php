<?php

namespace App\Domain\Account\Controller;

use App\Entity\Freelance;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Domain\Account\Form\FreelanceRegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class FreelanceRegisterController extends AbstractController
{
    #[Route('/inscription/freelance', name: 'app_freelance_register')]
    public function registerFreelance(Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $passwordHasher): Response
    {
        $freelance = new Freelance();
        $form = $this->createForm(FreelanceRegistrationFormType::class, $freelance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $freelance->setPassword($passwordHasher->hashPassword($freelance, $freelance->getPassword()));
            $freelance->setRoles(['ROLE_FREELANCE']);

            $em->persist($freelance);
            $em->flush();

             return $this->redirectToRoute('app_login');
        }

        return $this->render('account/freelance_register/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}
