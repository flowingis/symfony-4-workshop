<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TimeSpentRepository")
 */
class TimeSpent
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\Column(type="string", length=60)
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $progetto;

    /**
     * @ORM\Column(type="date")
     */
    private $data;

    /**
     * @ORM\Column(type="integer")
     */
    private $ore;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $utente;

    private function __construct() {}

    public static function create(UuidInterface $uuid, string $utente, string $progetto, DateTime $data, int $ore): TimeSpent
    {
        $ts = new self;
        $ts->id = $uuid;
        $ts->utente = $utente;
        $ts->progetto = $progetto;
        $ts->data = $data;
        $ts->ore = $ore;

        return $ts;
    }
}
