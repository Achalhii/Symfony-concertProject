<?php

namespace App\Entity;

use App\Repository\BandsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BandsRepository::class)
 */
class Bands
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
     * @ORM\ManyToOne(targetEntity=Pictures::class)
     */
    private $picture;

    /**
     * @ORM\ManyToOne(targetEntity=Artists::class)
     * @ORM\Column(type="array")
     */
    private $artist;

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

    public function getPicture(): ?Pictures
    {
        return $this->picture;
    }

    public function setPicture(?Pictures $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getArtist(): array
    {
        return $this->artist;
    }

    public function setArtist(?Artists $artist): self
    {
        $this->artist = [$artist->getId()];

        return $this;
    }
    public function addArtist(?Artists $artist): self
    {
        $this->artist[count($this->artist)] =  $artist->getId();

        return $this;
    }
}
