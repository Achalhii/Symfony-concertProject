<?php

namespace App\DataFixtures;

use App\Entity\Artists;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ArtistsFixturesPhp extends Fixture implements DependentFixtureInterface
{
    public const ARTISTS_SUPEROBAMIUM = 'artist_superobamium';
    public const ARTISTS_JOEBIDUM = 'artist_joebidum';
    public const ARTISTS_TRUMPET = 'artist_trumpet';
    public const ARTISTS_KANYEVEST = 'artist_kanyevest';
    public const ARTISTS_DOWNYJR = 'artist_downyjr';

    public function load(ObjectManager $manager): void
    {

        $SuperObamium = new Artists();
        $SuperObamium->setFirstName('Obamium')
            ->setLastName('Obamium2')
            ->setMail('Obamium@Earthium.ium')
            ->setPicture($this->getReference(PicturesFixturesPhp::PICTURE_SUPEROBAMIUM));
        $this->addReference(self::ARTISTS_SUPEROBAMIUM, $SuperObamium);
        $manager->persist($SuperObamium);

        $JoeBidum = new Artists();
        $JoeBidum->setFirstName('JoeBidum')
            ->setLastName('Bidum')
            ->setMail('JoeBidum@Earthium.ium')
            ->setPicture($this->getReference(PicturesFixturesPhp::PICTURE_JOEBIDUM));
        $this->addReference(self::ARTISTS_JOEBIDUM, $JoeBidum);
        $manager->persist($JoeBidum);

        $Trumpet = new Artists();
        $Trumpet->setFirstName('Trumpet')
            ->setLastName('Trumpet')
            ->setMail('Trumpet@Earthium.ium')
            ->setPicture($this->getReference(PicturesFixturesPhp::PICTURE_TRUMPET));
        $this->addReference(self::ARTISTS_TRUMPET, $Trumpet);
        $manager->persist($Trumpet);

        $KanyeVest = new Artists();
        $KanyeVest->setFirstName('KanyeVest')
            ->setLastName('Vest')
            ->setMail('KanyeVest@Earthium.ium')
            ->setPicture($this->getReference(PicturesFixturesPhp::PICTURE_KANYEVEST));
        $this->addReference(self::ARTISTS_KANYEVEST, $KanyeVest);
        $manager->persist($KanyeVest);

        $Downyjr = new Artists();
        $Downyjr->setFirstName('Downyjr')
            ->setLastName('JR')
            ->setMail('Downyjr@Earthium.ium')
            ->setPicture($this->getReference(PicturesFixturesPhp::PICTURE_DOWNYJR));
        $this->addReference(self::ARTISTS_DOWNYJR, $Downyjr);
        $manager->persist($Downyjr);

        $manager->flush();
    }
    public function getDependencies()
    {
        return [
            PicturesFixturesPhp::class,
        ];
    }
}
