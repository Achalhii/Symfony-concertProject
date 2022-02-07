<?php

namespace App\Entity;

use App\Repository\ConcertsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ConcertsRepository::class)
 */
class Concerts
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity=Pictures::class)
     */
    private $picture;

    /**
     * @ORM\ManyToOne(targetEntity=Bands::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $bands;

    /**
     * @ORM\ManyToOne(targetEntity=Organizations::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $organization;

    /**
     * @ORM\ManyToOne(targetEntity=Rooms::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $room;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getPicture(): ?Pictures
    {
        return $this->picture;
    }

    public function setPicture(?Pictures $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getBands(): ?Bands
    {
        return $this->bands;
    }

    public function setBands(?Bands $bands): self
    {
        $this->bands = $bands;

        return $this;
    }

    public function getOrganization(): ?Organizations
    {
        return $this->organization;
    }

    public function setOrganization(?Organizations $organization): self
    {
        $this->organization = $organization;

        return $this;
    }

    public function getRoom(): ?Rooms
    {
        return $this->room;
    }

    public function setRoom(?Rooms $room): self
    {
        $this->room = $room;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function getDateString(): ?string
    {
        return $this->date->format('Y-m-d H:i:s');
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
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
}
