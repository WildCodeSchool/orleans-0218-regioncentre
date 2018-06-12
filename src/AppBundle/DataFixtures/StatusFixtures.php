<?php
/**
 * Created by PhpStorm.
 * User: workstation
 * Date: 12/06/18
 * Time: 09:20
 */

namespace AppBundle\DataFixtures;

use AppBundle\Entity\Statut;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class StatusFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $statusOne = new Statut();
        $statusTwo = new Statut();
        $statusThree = new Statut();

        $statusOne->setName('En cours');
        $statusOne->setCode('waiting');
        $statusOne->setColor('#727072');

        $statusTwo->setName('Refusé');
        $statusTwo->setCode('rejected');
        $statusTwo->setColor('#EC4442');

        $statusThree->setName('Accepté');
        $statusThree->setCode('Accepted');
        $statusThree->setColor('#450292');

        $manager->persist($statusOne);
        $manager->persist($statusTwo);
        $manager->persist($statusThree);
        $manager->flush();

        $this->addReference('statusOne', $statusOne);
        $this->addReference('statusTwo', $statusTwo);
        $this->addReference('statusThree', $statusThree);
    }
}
