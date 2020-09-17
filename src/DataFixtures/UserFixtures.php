<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }


    public function load(ObjectManager $manager): void
    {
        $user1 = new User();
        $user1->setEmail('toto@toto.com');
        $user1->setLastName('tata');
        $user1->setFirstName('toto');
        $user1->setDuckName('coin');
        $user1->setImg('https://www.adeevee.com/aimages/200711/01/thai-fermentation-industry-co-rachachuros-seasoning-ashlyn-duck-pamela-pig-sasha-chicken-outdoor-38633-adeevee.jpg');
        $user1->setPassword($this->passwordEncoder->encodePassword(
            $user1,
            'toto'
        ));

        $manager->persist($user1);

        $user2 = new User();
        $user2->setEmail('tata@toto.com');
        $user2->setLastName('tata');
        $user2->setFirstName('toto');
        $user2->setDuckName('SuperCoin');
        $user2->setImg('https://images-na.ssl-images-amazon.com/images/I/51VXgNZFIoL._AC_SY355_.jpg');
        $user2->setPassword($this->passwordEncoder->encodePassword(
            $user1,
            'tata'
        ));
        $manager->persist($user2);

        $manager->flush();

    }
}
