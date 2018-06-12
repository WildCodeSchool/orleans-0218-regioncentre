<?php
/**
 * Created by PhpStorm.
 * User: workstation
 * Date: 12/06/18
 * Time: 08:29
 */

namespace AppBundle\DataFixtures;


use AppBundle\Entity\Analysis;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class AnalysisFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $analysisOne = new Analysis();
        $analysisTwo = new Analysis();
        $analysisThree = new Analysis();

        $analysisOne->setName('À portée des agents du lycée');
        $analysisOne->setStatus($this->getReference('statusOne'));

        $analysisTwo->setName('Travaux trop importants');
        $analysisTwo->setStatus($this->getReference('statusTwo'));

        $analysisThree->setName('Complete');
        $analysisThree->setStatus($this->getReference('statusThree'));

        $manager->persist($analysisOne);
        $manager->persist($analysisTwo);
        $manager->persist($analysisThree);
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            StatusFixtures::class,
        ];
    }
}