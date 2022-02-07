<?php

namespace App\DataFixtures;

use App\Entity\Organizations;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class OrganizationsFixturesPhp extends Fixture implements DependentFixtureInterface
{
    public const ORGANIZATION_ORGANIZIUM = 'organization_organizium';
    public function load(ObjectManager $manager): void
    {
        $Organizium = new Organizations();
        $Organizium->setName('Organizium')
            ->setMail('Organizium@earthuim.ium')
            ->setPicture($this->getReference(PicturesFixturesPhp::PICTURE_ORGANIZIUM));
        $this->addReference(self::ORGANIZATION_ORGANIZIUM,$Organizium);
        $manager->persist($Organizium);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            PicturesFixturesPhp::class,
        ];
    }
}
