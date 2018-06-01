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
        $userSuperAdmin->setWork('SUPER ADMINISTRATEUR TOUT PUISSANT');
        $userSuperAdmin->setMail('admin@region.com');
        $userSuperAdmin->setRoles(['ROLE_SUPER_ADMIN']);
        $userSuperAdmin->setEnabled(true);

        $password = $this->encoder->encodePassword($userSuperAdmin, '1234');
        $userSuperAdmin->setPassword($password);

        $manager->persist($userSuperAdmin);
        $manager->flush();
    }
}
