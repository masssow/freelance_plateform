<?php

namespace App\Tests;

use App\Entity\User;
use LDAP\Result;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private $user;

    protected function setUp(): void
    {
    $this->user = new User();

    }
    public function testUserCanSetAndGetEmail(): void
    {
        $email = 'douma.faye@mail.com';
        $this->user->setEmail($email);

        $this->assertEquals($email, $this->user->getEmail());
    }


    public function testUserCanSetAndGetPassword(): void
    {
        $password = 'passpassword';
        $this->user->setPassword($password);

        $this->assertEquals($password, $this->user->getPassword());
    }


    public function testUserGetsDefaultRole(): void
    {
        $roles = $this->user->getRoles();

        $this->assertContains('ROLE_USER', $roles);
    }

    public function testUserCanSetAndGetCustomRoles(): void
    {
        $customRoles = ['ROLE_ADMIN', 'ROLE_FREELANCE'];
        $this->user->setRoles($customRoles);

        $roles = $this->user->getRoles();

        $this->assertContains('ROLE_ADMIN', $roles);
        $this->assertContains('ROLE_FREELANCE', $roles);
        $this->assertContains('ROLE_USER', $roles);  // ROLE_USER doit toujours être ajouté
    }

    public function testUserIdentifierIsEmail(): void
    {
        $email = 'douma.faye@mail.com';
        $this->user->setEmail($email);

        $this->assertEquals($email, $this->user->getUserIdentifier());
    }


 
}
