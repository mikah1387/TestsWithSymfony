<?php

namespace App\Tests\Unit;

use App\Entity\Users;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UsersTest extends KernelTestCase
{


     public function getEntity(): Users
     {

         return (new Users())
                   ->setPseudo('testss')
                   ->setEmail('test@test.fr')
                   ->setPassword('testrrr')
                   ->setRoles(['ROLE_USER']);
        

     }
    public function testUserIsValid(): void
    {
        self::bootKernel();
        $container = static::getContainer();
        $user= $this->getEntity();
         
        $errors = $container->get('validator')->validate($user);
        $this->assertCount(0, $errors);     

             
    }

    public function testPseudoIsNotValid(): void
    {
        self::bootKernel();
        $container = static::getContainer();
        $user = $this->getEntity();
        $user->setPseudo('a');
         
        $errors = $container->get('validator')->validate($user);
        $this->assertCount(1, $errors);     
        $this->assertEquals('votre pseudo doit contenir au moins 5 caractères', $errors[0]->getMessage());

             
    }

    public function testUserIsNotValid(): void
    {
        self::bootKernel();
        $container = static::getContainer();
        $user = $this->getEntity();
        $user->setPseudo('tes');
        $user->setPassword('tes');
         
        $errors = $container->get('validator')->validate($user);
        $this->assertCount(2, $errors);     

             
    }
}
