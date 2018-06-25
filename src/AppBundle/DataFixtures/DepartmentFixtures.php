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
    public function load(ObjectManager $om)
    {
        $departments = [45 => 'Loiret'
            , 41 => 'Loire et cher'
            , 37 => 'Indre et loire'
            , 18 => 'Cher'
            , 28 => 'Eure-et-Loir'
            , 36 => 'Indre'
        ];
        foreach ($departments as $shortCode => $name) {
            $department = new Department();
            $department->setShortCode($shortCode)->setName($name);
            $this->addReference($name, $department);
            $om->persist($department);
        }
        $om->flush();

    }
}
