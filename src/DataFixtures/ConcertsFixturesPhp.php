<?php

namespace App\DataFixtures;


use App\Entity\Concerts;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ConcertsFixturesPhp extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $EUWConcert = new Concerts();
        $EUWConcert->setPrice(51)
            ->setName("EUWConcert")
            ->setPicture($this->getReference(PicturesFixturesPhp::PICTURE_SUPEROBAMIUM))
            ->setBands($this->getReference(BandsFixturesPhp::BANDS_BANDIUM))
            ->setOrganization($this->getReference(OrganizationsFixturesPhp::ORGANIZATION_ORGANIZIUM))
            ->setRoom($this->getReference(RoomsFixturesPhp::ROOM_MOSSON))
            ->setDate(\DateTime::createFromFormat("d/m/Y",'31/10/2022'));
        $manager->persist($EUWConcert);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            BandsFixturesPhp::class,
            RoomsFixturesPhp::class,
            PicturesFixturesPhp::class,
            OrganizationsFixturesPhp::class
        ];
    }
}
