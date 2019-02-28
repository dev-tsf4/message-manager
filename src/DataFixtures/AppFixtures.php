<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $this->loadUsers($manager);
    }

    public function loadUsers(ObjectManager $manager)
    {
        foreach ($this->getUsers() as [$email, $password, $lastname, $firstname, $roles]) {
            $user = new User();
            $user->setEmail($email);
            $user->setPassword($this->encoder->encodePassword($user, $password));
            $user->setLastName($lastname);
            $user->setFirstName($firstname);
            $user->setRoles($roles);

            $manager->persist($user);
        }

        $manager->flush();
    }

    public function getUsers()
    {
        return [
            ['admin@mail.com', 'admin', 'bowman', 'willie', ['ROLE_ADMIN_DASHBOARD']],
            ['adherent@mail.com', 'secret123', 'gabe', 'johnson', ['ROLE_USER']],
        ];
    }
}
