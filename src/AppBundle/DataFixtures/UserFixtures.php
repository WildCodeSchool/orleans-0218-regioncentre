<?php
/**
 * Created by PhpStorm.
 * User: workstation
 * Date: 31/05/18
 * Time: 17:22
 */

namespace AppBundle\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
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
        $userSuperAdmin->setFirstName('Ad');
        $userSuperAdmin->setLastName('MIN');
        $userSuperAdmin->setWork('ADMINISTRATEUR TOUT PUISSANT');
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
        $userEmop->setFirstName('Em');
        $userEmop->setLastName('OP');
        $userEmop->setWork('SUPER EMOP PAS TOUT PUISSANT');
        $userEmop->setMail('emp@region.com');
        $userEmop->setPhoneNumber('1234547891');
        $userEmop->setRoles(['ROLE_EMOP']);
        $userEmop->setEnabled(true);

        $password = $this->encoder->encodePassword($userEmop, '1234');
        $userEmop->setPassword($password);

        $manager->persist($userEmop);

        $userSchool = new User();

        $userSchool->setEmail('school@region.com');
        $userSchool->setUsername('school');
        $userSchool->setFirstName('Sc');
        $userSchool->setLastName('OOL');
        $userSchool->setWork('SUPER SCHOOL PAS TOUT PUISSANT');
        $userSchool->setMail('school@region.com');
        $userSchool->setPhoneNumber('1234568891');
        $userSchool->setRoles(['ROLE_LYCEE']);
        $userSchool->setEnabled(true);

        $password = $this->encoder->encodePassword($userSchool, '1234');
        $userSchool->setPassword($password);

        $manager->persist($userSchool);

        $manager->flush();

        $this->addReference('Admin', $userSuperAdmin);
    }
}
