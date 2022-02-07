<?php

namespace App\DataFixtures;

use App\Entity\Rooms;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RoomsFixturesPhp extends Fixture
{
    public const ROOM_MOSSON = 'room_mosson';
    public function load(ObjectManager $manager): void
    {
        $Mosson = new Rooms();
        $Mosson->setName('Stade de la mosson')
            ->setAdress('France, Montpellier')
            ->setMaximumPlace(1000);
        $this->addReference(self::ROOM_MOSSON,$Mosson);
        $manager->persist($Mosson);
        $manager->flush();
    }
}
