<?php

namespace App\Controller\Register;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterController extends AbstractController
{
    protected $em;
    protected $userRepository;
    protected $passwordEncoder;

    public function __construct(UserRepository $userRepository, EntityManagerInterface $em, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->userRepository = $userRepository;
        $this->em = $em;
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @Route("/register", name="register")
     */
    public function index(Request $request): Response
    {
        $user = new User();

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword($this->passwordEncoder->encodePassword($user, $user->getPassword()));

            $this->em->persist($user);
            $this->em->flush();

            return $this->redirectToRoute('app_login');
        }

        return $this->render('register/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
}
