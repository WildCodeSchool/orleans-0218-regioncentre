<?php
/**
 * Created by PhpStorm.
 * User: workstation
 * Date: 31/05/18
 * Time: 17:22
 */

namespace AppBundle\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $userSuperAdmin = new User();

        $userSuperAdmin->setEmail('admin@region.com');
        $userSuperAdmin->setUsername('admin');
        $userSuperAdmin->setFirstName('Yann');
        $userSuperAdmin->setLastName('Baduel');
        $userSuperAdmin->setWork('Administrateur du site');
        $userSuperAdmin->setMail('admin@region.com');
        $userSuperAdmin->setPhoneNumber('1234567891');
        $userSuperAdmin->setRoles(['ROLE_ADMIN']);
        $userSuperAdmin->setEnabled(true);

        $password = $this->encoder->encodePassword($userSuperAdmin, '1234');
        $userSuperAdmin->setPassword($password);

        $manager->persist($userSuperAdmin);

        $userEmop = new User();

        $userEmop->setEmail('emop@region.com');
        $userEmop->setUsername('emop');
        $userEmop->setFirstName('Prenom');
        $userEmop->setLastName('Nom');
        $userEmop->setWork('Emop');
        $userEmop->setMail('emp@region.com');
        $userEmop->setPhoneNumber('1234547891');
        $userEmop->setRoles(['ROLE_EMOP']);
        $userEmop->setEnabled(true);

        $password = $this->encoder->encodePassword($userEmop, '1234');
        $userEmop->setPassword($password);

        $manager->persist($userEmop);

        $userSchool = new User();

        $userSchool->setEmail('lycee@region.com');
        $userSchool->setUsername('lycee');
        $userSchool->setFirstName('Prenom');
        $userSchool->setLastName('Nom');
        $userSchool->setWork('Lycée');
        $userSchool->setMail('lycee@region.com');
        $userSchool->setPhoneNumber('1234568891');
        $userSchool->setLycee($this->getReference('lyceeOne'));
        $userSchool->setRoles(['ROLE_LYCEE']);
        $userSchool->setEnabled(true);

        $password = $this->encoder->encodePassword($userSchool, '1234');
        $userSchool->setPassword($password);

        $manager->persist($userSchool);

        $manager->flush();

        $this->addReference('Admin', $userSuperAdmin);
        $this->addReference('emop', $userEmop);
        $this->addReference('lycee', $userSchool);
    }

    public function getDependencies()
    {
        return [
            LyceeFixtures::class,
        ];
    }
}
