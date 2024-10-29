<?php

namespace App\Domain\Account\Controller;

use App\Entity\Client;
use App\Entity\Freelance;
use App\Entity\User;
use App\Form\AvatarUploadType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Domain\Account\Service\AccountService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Domain\Account\Form\ClientProfileEditFormType;
use Symfony\Component\String\Slugger\SluggerInterface;
use App\Domain\Account\Form\FreelanceProfileEditFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class AccountController extends AbstractController
{
    public function __construct(private AccountService $accountService)
    {}
    
    #[Route('/mon-compte', name: 'app_account')]
    public function index(): Response
    {
        $user = $this->getUser();
        $userType = match (true) {
            $user instanceof Client => 'client',
            $user instanceof Freelance => 'freelance',
            default => 'unknown',
        };
        if (!$user) {
            throw $this->createNotFoundException('Utilisateur non connecté');
        }


        return $this->render('account/profile/index.html.twig', [
            'user' => $user,
            'userType' => $userType,        ]);
    }

    #[Route('/modifier-mon-profil', name: 'app_edit_profile')]
    public function editProfile(Request $request): Response
    {
            $user = $this->getUser();
            $formType = $user instanceof Client ? ClientProfileEditFormType::class :  FreelanceProfileEditFormType::class;
            $form = $this->createForm($formType, $user::class);

            if($form->isValid() && $form->isSubmitted()){
                $this->accountService->updateProfile($user);
                $this->addFlash('success', 'Profil mis à jour avec succès.');

                return $this->redirectToRoute('app_account');

                
            }
        return $this->render('account/profile/edit_profile.html.twig', [
            'controller_name' => 'AccountController',
        ]);
    
    }
    #[Route('/mon-compte/supprimer-mon-compte', name: 'app_delete-account')]
    public function deleteAccount(): Response 
    {
        $user = $this->getUser();
        $this->accountService->deleteAccount($user);
        $this->addFlash('info', 'Votre compte a été supprimé.');

        return $this->redirectToRoute('app_logout');

        return $this->render('account/profile/delete_account.html.twig', [
            'controller_name' => 'AccountController',
        ]);
    }

    


    
}
