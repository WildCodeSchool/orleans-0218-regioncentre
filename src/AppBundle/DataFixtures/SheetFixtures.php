<?php
/**
 * Created by PhpStorm.
 * User: wilder7
 * Date: 30/05/18
 * Time: 14:35
 */

namespace AppBundle\DataFixtures;

use AppBundle\Entity\Metier;
use AppBundle\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Sheet;

class SheetFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $sheet = new Sheet();
        $sheet->setUrgent(1);
        $sheet->setSubject('Travaux dans la classe B12');
        $sheet->setBuildings('Batiment 50');
        $sheet->setConstraintsBuildings('Pas d\'ascenseur, intervention au 85ieme étages');
        $sheet->setConstraintsTechnicals('Pas d\'éléctricité dans le batiment');
        $sheet->setDescription('Changer le parquet, les murs, et les fenetres');
        $sheet->setStartWork(new \DateTime(2018-06-14));
        $sheet->setEndWork(new \DateTime(2019-05-15));
        $sheet->setCreationDate(new \DateTime('NOW'));
        $sheet->setJob($this->getReference('Plombier'));
        $sheet->setStatus($this->getReference('statusOne'));
        $sheet->setUser($this->getReference('Admin'));

        $manager->persist($sheet);
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            StatusFixtures::class,
            MetierFixtures::class,
            UserFixtures::class,
        ];
    }
}
