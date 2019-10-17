<?php


namespace App\UseCase;

use App\DTO\TrackDto;
use App\Entity\Account;
use App\Entity\TimeSpent;
use App\Repository\TimeSpentRepository;
use Ramsey\Uuid\Uuid;

final class InsertSpentHour
{
    public function __construct(TimeSpentRepository $timeRepo)
    {
        $this->timeRepo = $timeRepo;
    }

    public function execute(Account $user, TrackDto $trackDto): void
    {
        // todo: cosa succedere se non ci sono ore
        $oreLavorate = $this->timeRepo->countHours($user, $trackDto->getData());


        $totOre = $oreLavorate + $trackDto->getOre();

        if ($totOre > 8) {
            $msg = "Non puoi lavorare $totOre ore nel giorno {$trackDto->getData()->format('Y-d-m')}";

            throw new \RuntimeException($msg);
        }

        $ts = TimeSpent::create(
            Uuid::uuid4(),
            $user->getId(),
            $trackDto->getProgetto(),
            $trackDto->getData(),
            $trackDto->getOre()
        );

        $this->timeRepo->save($ts);
    }
}