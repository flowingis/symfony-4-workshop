<?php

namespace App\DataFixtures;

use App\Entity\Account;
use App\Entity\TimeSpent;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AccountFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $account = Account::create(Uuid::uuid4(), 'michele.orselli@gmail.com', 'banana', $this->encoder);

        $date = new \DateTime('2019-10-10');
        $ore = 5;

        $ts = TimeSpent::create(Uuid::uuid4(), $account->getId(), 'progetto 1', $date, $ore);

        $manager->persist($account);
        $manager->persist($ts);
        $manager->flush();
    }
}
