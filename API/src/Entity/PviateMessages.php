<?php

namespace App\Entity;

use App\Repository\PviateMessagesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PviateMessagesRepository::class)
 */
class PviateMessages
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $creation_time;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $message;

    /**
     * @ORM\Column(type="integer")
     */
    private $creator_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $destinator_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreationTime(): ?\DateTimeInterface
    {
        return $this->creation_time;
    }

    public function setCreationTime(\DateTimeInterface $creation_time): self
    {
        $this->creation_time = $creation_time;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getCreatorId(): ?int
    {
        return $this->creator_id;
    }

    public function setCreatorId(int $creator_id): self
    {
        $this->creator_id = $creator_id;

        return $this;
    }

    public function getDestinatorId(): ?int
    {
        return $this->destinator_id;
    }

    public function setDestinatorId(int $destinator_id): self
    {
        $this->destinator_id = $destinator_id;

        return $this;
    }
}
