<?php
/**
 * Created by PhpStorm.
 * User: wilder7
 * Date: 30/05/18
 * Time: 14:35
 */

namespace AppBundle\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Metier;
use AppBundle\Entity\Role;

class MetierFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $metier = new Metier();
        $metier->setName('Serrurier');

        $metier2 = new Metier();
        $metier2->setName('Plombier');

        $metier3 = new Metier();
        $metier3->setName('Électricien');

        $manager->persist($metier);
        $manager->persist($metier2);
        $manager->persist($metier3);

        $manager->flush();

        $this->addReference('Serrurier', $metier);
        $this->addReference('Plombier', $metier2);
        $this->addReference('Électricien', $metier3);

    }
}
