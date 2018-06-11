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
use AppBundle\Entity\Department;

class DepartmentFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $department = new Department();
        $department->setDepartment('Loiret');

        $department1 = new Department();
        $department1->setDepartment('Indre et Loire');

        $department2 = new Department();
        $department2->setDepartment('Cher');

        $manager->persist($department);
        $manager->persist($department1);
        $manager->persist($department2);

        $manager->flush();
    }
}

