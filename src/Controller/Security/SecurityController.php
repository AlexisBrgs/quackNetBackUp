<?php

namespace App\Controller\Security;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $lastUsername = $authenticationUtils->getLastUsername();

        if ($this->getUser()) {
            dump($this->getUser());
            return $this->redirectToRoute('quack_index');
        }

        $error = $authenticationUtils->getLastAuthenticationError();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("logout", name="app_logout")
     */
    public function logout(): Response
    {
           return $this->redirectToRoute('quack_index');
    }
}
