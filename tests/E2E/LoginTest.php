<?php

namespace App\Tests\E2E;

use App\Repository\UsersRepository;
use Symfony\Component\Panther\PantherTestCase;

class LoginTest extends PantherTestCase
{
    public function testLoginWithValidCredentials(): void
    {
        $client = self::createPantherClient(['browser' => PantherTestCase::CHROME]);
        $crawler = $client->request('GET', '/login');   
        $this->assertSelectorTextContains('form h1', 'Se connecter'); 
        $form = $crawler->selectButton('Se connecter')->form([
            'email' => 'achache.hakim@gmail.com',
            'password' => 'aaaaaa',
        ]);

        $client->submit($form); 

        $currentUrl = $client->getCurrentURL();
        $this->assertStringContainsString('/', $currentUrl);
        $this->assertSelectorTextContains('#pseudo', 'bienvenu Mr mikah');
      
       
    }
}
