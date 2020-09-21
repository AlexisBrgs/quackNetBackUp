<?php


namespace App\UserService;


use App\Entity\User;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class UserService
{
    public function __construct(
        EntityManagerInterface $em,
        SessionInterface $session
    )
    {
        $this->em = $em;
        $this->session = $session;
    }

    public function getUser():?User
    {
    $userName = $this->session->get('_security.last_username');
    $user= $this->em->getRepository(User::class)->findOneBy(['email' => $userName ]);
    return $user;
}
}
