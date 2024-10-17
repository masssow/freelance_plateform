<?php

namespace App\Tests;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testUserMail(): void
    {
        $user = new USER();
        $email = 'test@email.com';

        $user->setEmail($email);
        $this->assertSame($email,$user->getEmail());
    }

    public function testUserRoles()
    {
        $user = new User();
        $roles = 'ROLE_ADMIN';

        // Vérifier si les rôles peuvent être définis et récupérés
        $user->setRole($roles);
        $this->assertSame($roles, $user->getRole());
    }


    public function testPassword(): void
    {
        $user = new USER();
        $motDePasse = 'passpass';
        $user->setMotDePasse($motDePasse);
        $this->assertSame($motDePasse, $user->getMotDePasse());
    }

    public function testUserIdIsNotNullInitially(): void
    {
        $user = new USER();
        $this->assertNull($user->getId());
    }
}
