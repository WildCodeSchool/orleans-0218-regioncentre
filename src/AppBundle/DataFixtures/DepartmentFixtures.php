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
        $DepartmentOne = new Department();
        $DepartmentTwo = new Department();
        $DepartmentThree = new Department();
        $DepartmentFour = new Department();
        $DepartmentFive = new Department();
        $DepartmentSix = new Department();

        $DepartmentOne->setName('Loiret');
        $DepartmentOne->setshortCode(45);

        $DepartmentTwo->setName('loire et cher');
        $DepartmentTwo->setshortCode(41);

        $DepartmentThree->setName('Indre et loire');
        $DepartmentThree->setshortCode(37);

        $DepartmentFour->setName('Cher');
        $DepartmentFour->setshortCode(18);

        $DepartmentFive->setName('Eure-et-Loir');
        $DepartmentFive->setshortCode(28);

        $DepartmentSix->setName('Indre');
        $DepartmentSix->setshortCode(36);

        $manager->persist($DepartmentOne);
        $manager->persist($DepartmentTwo);
        $manager->persist($DepartmentThree);
        $manager->persist($DepartmentFour);
        $manager->persist($DepartmentFive);
        $manager->persist($DepartmentSix);
        $manager->flush();
    }

}