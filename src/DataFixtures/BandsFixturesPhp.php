<?php

namespace App\DataFixtures;

use App\Entity\Bands;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class BandsFixturesPhp extends Fixture implements DependentFixtureInterface
{
    public const BANDS_BANDIUM = 'band_bandium';
    public const BANDS_SUPRUMEDUO = 'band_suprumeduo';

    public function load(ObjectManager $manager): void
    {
        $Bandium = new Bands();
        $Bandium->setName('Bandium')
            ->setPicture($this->getReference(PicturesFixturesPhp::PICTURE_ORGANIZIUM))
            ->setArtist($this->getReference(ArtistsFixturesPhp::ARTISTS_SUPEROBAMIUM))
            ->addArtist($this->getReference(ArtistsFixturesPhp::ARTISTS_DOWNYJR))
            ->addArtist($this->getReference(ArtistsFixturesPhp::ARTISTS_TRUMPET))
            ->addArtist($this->getReference(ArtistsFixturesPhp::ARTISTS_KANYEVEST))
            ->addArtist($this->getReference(ArtistsFixturesPhp::ARTISTS_JOEBIDUM));
        $this->addReference(self::BANDS_BANDIUM, $Bandium);
        $manager->persist($Bandium);

        $SuprumeDUO = new Bands();
        $SuprumeDUO->setName('SuprumeDUO')
            ->setPicture($this->getReference(PicturesFixturesPhp::PICTURE_SUPRUMEDUO))
            ->setArtist($this->getReference(ArtistsFixturesPhp::ARTISTS_SUPEROBAMIUM))
            ->addArtist($this->getReference(ArtistsFixturesPhp::ARTISTS_JOEBIDUM));
        $this->addReference(self::BANDS_SUPRUMEDUO, $SuprumeDUO);
        $manager->persist($SuprumeDUO);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            PicturesFixturesPhp::class,
            ArtistsFixturesPhp::class
        ];
    }
}
