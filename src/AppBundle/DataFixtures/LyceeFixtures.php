<?php
/**
 * Created by PhpStorm.
 * User: workstation
 * Date: 12/06/18
 * Time: 08:29
 */

namespace AppBundle\DataFixtures;

use AppBundle\Entity\Department;
use AppBundle\Entity\Lycee;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LyceeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $lycee = new Lycee();
        $lycee->setName('Charles Péguy');
        $lycee->setAddress('1 Cours Victor Hugo');
        $lycee->setPostalCode(45074);
        $lycee->setCity('Orléans');
        $lycee->setDepartment($this->getReference('Loiret'));


        $manager->persist($lycee);

        $lycee1 = new Lycee();
        $lycee1->setName('Philibert Dessaignes');
        $lycee1->setAddress('12 Rue Dessaignes, 41007 Blois');
        $lycee1->setPostalCode(41007);
        $lycee1->setCity('Blois');
        $lycee1->setDepartment($this->getReference('Loire et cher'));

        $manager->persist($lycee1);

        $lycee2 = new Lycee();
        $lycee2->setName('Jean Monnet');
        $lycee2->setAddress('45 Rue de la Gitonnière');
        $lycee2->setPostalCode(37300);
        $lycee2->setCity('Joué-lès-Tours');
        $lycee2->setDepartment($this->getReference('Indre et loire'));

        $manager->persist($lycee2);

        $lycee3 = new Lycee();
        $lycee3->setName('Henri Brisson');
        $lycee3->setAddress('25 Avenue Henri Brisson');
        $lycee3->setPostalCode(18100);
        $lycee3->setCity('Vierzon');
        $lycee3->setDepartment($this->getReference('Cher'));

        $manager->persist($lycee3);

        $lycee4 = new Lycee();
        $lycee4->setName('Jehan de Beauce');
        $lycee4->setAddress('20 Rue du Commandant Léon Chesne');
        $lycee4->setPostalCode(28000);
        $lycee4->setCity('Chartres');
        $lycee4->setDepartment($this->getReference('Eure-et-Loir'));

        $manager->persist($lycee4);

        $lycee5 = new Lycee();
        $lycee5->setName('Blaise Pascal');
        $lycee5->setAddress('27 Boulevard Blaise Pascal');
        $lycee5->setPostalCode(36000);
        $lycee5->setCity('Châteauroux');
        $lycee5->setDepartment($this->getReference('Indre'));

        $manager->persist($lycee5);

        $manager->flush();

        $this->addReference('lyceeOne', $lycee);
    }

    public function getDependencies()
    {
        return [
            DepartmentFixtures::class,
        ];
    }
}
