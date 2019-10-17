<?php

namespace App\DTO;

use DateTime;
use Symfony\Component\Validator\Constraints as Assert;

class TrackDto
{
    const PROGETTI = ['progetto 1', 'progetto 2', 'progetto 3'];

    /**
     * @Assert\NotBlank
     * @Assert\Choice(choices=TrackDto::PROGETTI, message="Scegli un progetto valido")
     */
    private $progetto;

    /**
     * @Assert\NotBlank
     * @Assert\LessThanOrEqual("today")
     * @Assert\Type("datetime")
     */
    private $data;

    /**
     * @Assert\NotBlank
     * @Assert\Type("int")
     * @Assert\GreaterThan(0)
     * @Assert\LessThanOrEqual(8)
     */
    private $ore;

    public function getProgetto(): ?string
    {
        return $this->progetto;
    }

    public function getData(): ?DateTime
    {
        return $this->data;
    }

    public function getOre(): ?int
    {
        return $this->ore;
    }

    public function setProgetto(string $progetto): void
    {
        $this->progetto = $progetto;
    }

    public function setData(DateTime $data): void
    {
        $this->data = $data;
    }

    public function setOre(int $ore): void
    {
        $this->ore = $ore;
    }

}