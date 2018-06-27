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
use AppBundle\Entity\Sheet;

class SheetFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $sheet = new Sheet();
        $sheet->setUrgent(1);
        $sheet->setSubject('Travaux dans la classe B12');
        $sheet->setBuildings('Batiment 50');
        $sheet->setConstraintsBuildings('Pas d\'ascenseur, intervention au 5ieme étages');
        $sheet->setConstraintsTechnicals('Pas d\'éléctricité dans le batiment');
        $sheet->setDescription('Changer le parquet et les fenetres');
        $sheet->setStartWork(new \DateTime(2018-04-14));
        $sheet->setEndWork(new \DateTime(2019-05-15));
        $sheet->setCreationDate(new \DateTime('NOW'));
        $sheet->setJob($this->getReference('Plombier'));
        $sheet->setStatus($this->getReference('statusOne'));
        $sheet->setUser($this->getReference('lycee'));

        $manager->persist($sheet);

        $sheet2 = new Sheet();
        $sheet2->setUrgent(1);
        $sheet2->setSubject('Travaux dans la classe B15');
        $sheet2->setBuildings('Batiment 50');
        $sheet2->setConstraintsBuildings('');
        $sheet2->setConstraintsTechnicals('');
        $sheet2->setDescription('Éléctricité à refaire.');
        $sheet2->setStartWork(new \DateTime(2018-05-14));
        $sheet2->setEndWork(new \DateTime(2019-07-15));
        $sheet2->setCreationDate(new \DateTime('NOW'));
        $sheet2->setJob($this->getReference('Électricien'));
        $sheet2->setStatus($this->getReference('statusOne'));
        $sheet2->setUser($this->getReference('lycee'));

        $manager->persist($sheet2);

        $sheet3 = new Sheet();
        $sheet3->setUrgent(1);
        $sheet3->setSubject('Travaux dans le Hall');
        $sheet3->setBuildings('Batiment 3');
        $sheet3->setConstraintsBuildings('');
        $sheet3->setConstraintsTechnicals('');
        $sheet3->setDescription('Peinture à refaire');
        $sheet3->setStartWork(new \DateTime(2018-06-14));
        $sheet3->setEndWork(new \DateTime(2019-07-15));
        $sheet3->setCreationDate(new \DateTime('NOW'));
        $sheet3->setJob($this->getReference('Peintre'));
        $sheet3->setStatus($this->getReference('statusOne'));
        $sheet3->setUser($this->getReference('lycee'));

        $manager->persist($sheet3);

        $sheet4 = new Sheet();
        $sheet4->setUrgent(1);
        $sheet4->setSubject('Intervention plomberie');
        $sheet4->setBuildings('Batiment 5');
        $sheet4->setConstraintsBuildings('');
        $sheet4->setConstraintsTechnicals('');
        $sheet4->setDescription('Fuite toilettes 4ieme étage');
        $sheet4->setStartWork(new \DateTime(2018-06-14));
        $sheet4->setEndWork(new \DateTime(2019-07-15));
        $sheet4->setCreationDate(new \DateTime('NOW'));
        $sheet4->setJob($this->getReference('Plombier'));
        $sheet4->setStatus($this->getReference('statusOne'));
        $sheet4->setUser($this->getReference('lycee'));

        $manager->persist($sheet4);

        $manager->flush();

        $this->addReference('sheetOne', $sheet);
        $this->addReference('sheetTwo', $sheet2);
        $this->addReference('sheetThree', $sheet3);
        $this->addReference('sheetFour', $sheet4);
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
