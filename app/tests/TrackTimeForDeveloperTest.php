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
            'progetto' => 'progetto 3',
            'data' => '2019-11-01',
            'ore' => 9
            ]
        ]);

        $crawler = $client->submit($form);

        $this->assertContains('This value should be less than or equal to', $crawler->filter('.form-error-message')->eq(0)->text());
        $this->assertContains('This value should be less than or equal to 8', $crawler->filter('.form-error-message')->eq(1)->text());


        $form->setValues(['track' => [
            'progetto' => 'progetto 3',
            'data' => '2019-10-10',
            'ore' => 5
        ]
        ]);

        $crawler = $client->submit($form);

        $this->assertContains('Non puoi lavorare 10 ore nel giorno 2019-10-10', $crawler->filter('.message')->text());
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
