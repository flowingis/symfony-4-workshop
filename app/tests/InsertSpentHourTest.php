<?php

namespace App\Tests;

use App\DTO\TrackDto;
use App\Entity\Account;
use App\Repository\TimeSpentRepository;
use App\UseCase\InsertSpentHour;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class InsertSpentHourTest extends TestCase
{
    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage  Non puoi lavorare 12 ore nel giorno 2019-10-10
     */
    public function testShouldThrowExceptionWhenAddingMoreThan8Hours()
    {
        $encoder = $this->prophesize(UserPasswordEncoderInterface::class);

        $date = new \DateTime('2019-10-10');

        $account = Account::create(
            Uuid::uuid4(),
            'mo@example.com',
            'banana',
            $encoder->reveal()
        );

        $timeRepo = $this->prophesize(TimeSpentRepository::class);
        $timeRepo
            ->countHours($account, $date)
            ->willReturn(7);

        $dto = new TrackDto();
        $dto->setData($date);
        $dto->setOre(5);
        $dto->setProgetto('progetto 1');


        $uc = new InsertSpentHour($timeRepo->reveal());
        $uc->execute($account, $dto);
    }
}
