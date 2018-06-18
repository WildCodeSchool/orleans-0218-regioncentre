<?php
/**
 * Created by PhpStorm.
 * User: ziadoof
 * Date: 18/06/18
 * Time: 14:27
 */

namespace AppBundle\DataFixtures;

use AppBundle\Entity\Department;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class DepartmentFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $departmentOne = new Department();
        $departmentTwo = new Department();
        $departmentThree = new Department();
        $departmentFour = new Department();
        $departmentFive = new Department();
        $departmentSix = new Department();

        $departmentOne->setName('Loiret');
        $departmentOne->setshortCode(45);

        $departmentTwo->setName('loire et cher');
        $departmentTwo->setshortCode(41);

        $departmentThree->setName('Indre et loire');
        $departmentThree->setshortCode(37);

        $departmentFour->setName('Cher');
        $departmentFour->setshortCode(18);

        $departmentFive->setName('Eure-et-Loir');
        $departmentFive->setshortCode(28);

        $departmentSix->setName('Indre');
        $departmentSix->setshortCode(36);

        $manager->persist($departmentOne);
        $manager->persist($departmentTwo);
        $manager->persist($departmentThree);
        $manager->persist($departmentFour);
        $manager->persist($departmentFive);
        $manager->persist($departmentSix);
        $manager->flush();
    }
}
