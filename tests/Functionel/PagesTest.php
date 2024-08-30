<?php

namespace App\Tests\Functionel;

use App\Repository\UsersRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class PagesTest extends WebTestCase
{
    public function testHomePage(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

       
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        $this->assertSelectorTextContains('h1', 'projet la plateforme');
    }

    public function testRegisterPage(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/register');
        $buttuon = $crawler->selectButton('S\'inscrire');
        $this->assertResponseIsSuccessful();

        $this->assertCount(1, $buttuon);
        $this->assertSelectorTextContains('h1', 'S\'inscrire');
        $this->assertSelectorExists('form[method="post"]');
        $this->assertSelectorExists('input[name="registration_form[email]"]');
       
        
    }
    public function testRegisterWithValidData()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/register');
        $form = $crawler->selectButton('S\'inscrire')->form([
            'registration_form[pseudo]' => 'newuser',
            'registration_form[email]' => 'newuser@example5.com',
            'registration_form[plainPassword]' => 'password123',
            'registration_form[agreeTerms]' => true
        ]);

        $client->submit($form); 
        $this->assertResponseRedirects('/');
        $client->followRedirect();
        $userRepository = static::getContainer()->get(UsersRepository::class);
        $user = $userRepository->findOneByEmail('newuser@example3.com');
        $this->assertNotNull($user);
        $this->assertEquals('newuser', $user->getPseudo());
    }
}
