<?php

namespace App\DataFixtures;

use App\Entity\Pictures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PicturesFixturesPhp extends Fixture
{
    public const PICTURE_SUPEROBAMIUM = 'picture_superobamium';
    public const PICTURE_ORGANIZIUM = 'picture_organizium';
    public const PICTURE_JOEBIDUM = 'picture_joebidome';
    public const PICTURE_TRUMPET = 'picture_trumpet';
    public const PICTURE_KANYEVEST = 'picture_kanyvest';
    public const PICTURE_DOWNYJR = 'picture_downyjr';
    public const PICTURE_SUPRUMEDUO = 'picture_suprumeduo';

    public function load(ObjectManager $manager): void
    {
        $SuperObamium = new Pictures();
        $SuperObamium->setName('SuperObamium')
            ->setAlternativeName('SuperObamium Never Die')
            ->setUrl('https://webinfo.iutmontp.univ-montp2.fr/~achalhii/concertProject/image/SuperObamium.jpg');
        $this->addReference(self::PICTURE_SUPEROBAMIUM,$SuperObamium);
         $manager->persist($SuperObamium);

        $JoeBidum = new Pictures();
        $JoeBidum->setName('JoeBidome')
            ->setAlternativeName('JoeBidome Never Die')
            ->setUrl('https://webinfo.iutmontp.univ-montp2.fr/~achalhii/concertProject/image/JoeBidome.png');
        $this->addReference(self::PICTURE_JOEBIDUM,$JoeBidum);
        $manager->persist($JoeBidum);

        $Trumpet = new Pictures();
        $Trumpet->setName('Trumpet')
            ->setAlternativeName('Trumpet Never Die')
            ->setUrl('https://webinfo.iutmontp.univ-montp2.fr/~achalhii/concertProject/image/Trumpet.jpg');
        $this->addReference(self::PICTURE_TRUMPET,$Trumpet);
        $manager->persist($Trumpet);

        $KanyeVest = new Pictures();
        $KanyeVest->setName('KanyeVest')
            ->setAlternativeName('KanyeVest Never Die')
            ->setUrl('https://webinfo.iutmontp.univ-montp2.fr/~achalhii/concertProject/image/KanyeVest.jpg');
        $this->addReference(self::PICTURE_KANYEVEST,$KanyeVest);
        $manager->persist($KanyeVest);

        $DownyJR = new Pictures();
        $DownyJR->setName('$DownyJR')
            ->setAlternativeName('$DownyJR Never Die')
            ->setUrl('https://webinfo.iutmontp.univ-montp2.fr/~achalhii/concertProject/image/DownyJR.png');
        $this->addReference(self::PICTURE_DOWNYJR,$DownyJR);
        $manager->persist($DownyJR);

        $Organizium = new Pictures();
        $Organizium->setName('Organizium')
            ->setAlternativeName('Organizium Never Die')
            ->setUrl('https://webinfo.iutmontp.univ-montp2.fr/~achalhii/concertProject/image/Bandium.png');
        $this->addReference(self::PICTURE_ORGANIZIUM,$Organizium);
        $manager->persist($Organizium);

        $Suprumeduo = new Pictures();
        $Suprumeduo->setName('Suprumeduo')
            ->setAlternativeName('Suprumeduo Never Die')
            ->setUrl('https://webinfo.iutmontp.univ-montp2.fr/~achalhii/concertProject/image/Suprumeduo.png');
        $this->addReference(self::PICTURE_SUPRUMEDUO,$Suprumeduo);
        $manager->persist($Suprumeduo);

        $manager->flush();
    }
}
