<?php

namespace App\Tests;

use App\DataFixtures\AccountFixtures;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TrackTimeForDeveloperTest extends WebTestCase
{
    use FixturesTrait;

    public function testShouldBeAbleToTrackSpentHoursOnProject()
    {
        $this->loadFixtures([AccountFixtures::class]);

        $client = static::createClient();

        $this->login($client);

        $crawler = $client->request('GET', '/track');

        $form = $crawler->selectButton('Save')->form();

        $form->setValues(['track' => [
            'progetto' => 'progetto 1',
            'data' => '2019-10-10',
            'ore' => '4'
            ]
        ]);

        $crawler = $client->submit($form);

        $this->assertContains('ore inserite', $crawler->filter('.message')->text());
    }

    private function login(KernelBrowser $client): void
    {
        $crawler = $client->request('GET', '/login');

        $form = $crawler->selectButton('Sign in')->form();
        $form->setValues(['email' => 'michele.orselli@gmail.com', 'password' => 'banana']);

        $client->submit($form);

        $client->followRedirect();
    }

}
