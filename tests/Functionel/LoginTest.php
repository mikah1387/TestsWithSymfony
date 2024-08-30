<?php

namespace App\Tests\Functionel;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class LoginTest extends WebTestCase
{
    public function testLoginPage(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Se connecter');
        
        $this->assertSelectorExists('form[method="post"]');
        $this->assertSelectorExists('input[name="email"]');
        $this->assertSelectorExists('input[name="password"]');
       

 

    }

    // public function testLoginWithValidCredentials(): void
    // {

    //     $client = static::createClient();
    //     $crawler = $client->request('GET', '/login');
    //     $loginbuttuon = $crawler->selectButton('Se connecter');
    //     $form = $loginbuttuon->form([
    //         'email' => 'achache.hakim@gmail.com',
    //         'password' => 'aaaaaa',
    //     ]);
    //     $client->submit($form);
    //     $this->assertResponseRedirects('/') ;        
    //     $client->followRedirect();
    //     $this->assertResponseStatusCodeSame(200);
    //     $this->assertSelectorTextContains('h1', 'projet la plateforme');

    // }
    public function testLoginBadCredentials(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');
         $form = $crawler->selectButton('Se connecter')->form([
            'email' => 'achache.hakim@gmail.com',
            'password' => 'admin',  
        ]);

        $client->submit($form);
        $this->assertResponseRedirects('/login') ;        
        $client->followRedirect();
        $this->assertResponseStatusCodeSame(200);          
        $this->assertSelectorTextContains('.alert-danger', 'Invalid credentials.');           
        
    }

}
