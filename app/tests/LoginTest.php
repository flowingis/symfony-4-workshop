<?php

namespace App\Tests;

use App\DataFixtures\AccountFixtures;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LoginTest extends WebTestCase
{
    use FixturesTrait;

    public function testCanLogin()
    {
        $this->loadFixtures([AccountFixtures::class]);

        $client = static::createClient();
        $crawler = $client->request('GET', '/login');

        $form = $crawler->selectButton('Sign in')->form();
        $form->setValues(['email' => 'michele.orselli@gmail.com', 'password' => 'banana']);

        $client->submit($form);

        $client->followRedirect();

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'michele.orselli@gmail.com');
    }
}
