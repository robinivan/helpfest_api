<?php

namespace App\Entity;

use App\Repository\SectorRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SectorRepository::class)
 */
class Sector
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $number_of_people;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $activity;

    /**
     * @ORM\Column(type="integer")
     */
    private $cleanliness;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getNumberOfPeople(): ?int
    {
        return $this->number_of_people;
    }

    public function setNumberOfPeople(?int $number_of_people): self
    {
        $this->number_of_people = $number_of_people;

        return $this;
    }

    public function getActivity(): ?string
    {
        return $this->activity;
    }

    public function setActivity(?string $activity): self
    {
        $this->activity = $activity;

        return $this;
    }

    public function getCleanliness(): ?int
    {
        return $this->cleanliness;
    }

    public function setCleanliness(int $cleanliness): self
    {
        $this->cleanliness = $cleanliness;

        return $this;
    }
}
