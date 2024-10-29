<?php

namespace App\Domain\Account\Service;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AccountService
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private UserPasswordHasherInterface $passwordHasher)
    {
        $this->entityManager = $entityManager;
        $this->passwordHasher = $passwordHasher;  
    }

    public function updateProfile(User $user): void
    {
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }

    public function changePassword(User $user, string $newPassword)
    {
       $hashedPassword =  $this->passwordHasher->hashPassword($user, $newPassword);
       $user->setPassword($hashedPassword);

       $this->entityManager->persist($user);
       $this->entityManager->flush();
    }

    public function deleteAccount(User $user)
    {
        $this->entityManager->remove($user);
        $this->entityManager->flush();
    }
}