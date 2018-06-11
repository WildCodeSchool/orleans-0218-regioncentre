<?php
/**
 * Created by PhpStorm.
 * User: wilder7
 * Date: 30/05/18
 * Time: 14:35
 */

namespace AppBundle\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Lycee;

class LyceeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $lycee = new Lycee();
        $lycee->setName('Simon Hugo');
        $lycee->setAddress('15 rue Jeanne d\'Arc');
        $lycee->setPostalCode('45000');
        $lycee->setCity('Orléans');

        $lycee1 = new Lycee();
        $lycee1->setName('Raymond Baudelaire');
        $lycee1->setAddress('30 rue du gros livre');
        $lycee1->setPostalCode('41000');
        $lycee1->setCity('Blois');

        $lycee2 = new Lycee();
        $lycee2->setName('Pierre de Maupassant');
        $lycee2->setAddress('40 avenue du champs');
        $lycee2->setPostalCode('18000');
        $lycee2->setCity('Chartres');

        $manager->persist($lycee);
        $manager->persist($lycee1);
        $manager->persist($lycee2);

        $manager->flush();
    }

    public function getDependencies()
    {
        return[
            LoadDepartmentData::class,
        ];
    }
}

