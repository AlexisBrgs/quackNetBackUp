<?php

namespace App\Controller\Quack;

use App\Entity\Quack;
use App\Entity\User;
use App\Form\QuackType;
use App\Repository\QuackRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/quack")
 */
class QuackController extends AbstractController
{
    protected $quackRepository;
    protected $em;
    protected $session;

    public function __construct(
        QuackRepository $quackRepository,
        EntityManagerInterface $em,
        SessionInterface $session
    )
    {
        $this->quackRepository = $quackRepository;
        $this->em = $em;
        $this->session = $session;
    }


    /**
     * @Route("/", name="quack_index", methods={"GET"})
     */
    public function index(): Response
    {
        return $this->render('quack/index.html.twig', [
            'quacks' => $this->quackRepository->findAll(),
        ]);
    }

    /**
     * @Route("/myQuacks", name="my_quacks", methods={"GET"})
     */
    public function myQuacks(): Response
    {

        return $this->render('quack/myQuacks.html.twig', [
            'quacks' => $this->getUser()->getQuacks()
        ]);
    }

    /**
     * @Route("/new", name="quack_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $quack = new Quack();

        $form=$this->createForm(QuackType::class, $quack)->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $quack->setUser($this->getUser());
            $this->em->persist($quack);
            $this->em->flush();
            $this->addFlash('created', 'Your quack has been added !');

            return $this->redirectToRoute('quack_index');
        }

        return $this->render('quack/new.html.twig', [
            'quack' => $quack,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="quack_show", methods={"GET"})
     */
    public function show(Quack $quack): Response
    {
        return $this->render('quack/show.html.twig', [
            'quack' => $quack,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="quack_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Quack $quack): Response
    {

        $form = $this->createForm(QuackType::class, $quack);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            $this->addFlash('edited', 'Your quack has been edited !');

            return $this->redirectToRoute('quack_index');
        }

        return $this->render('quack/edit.html.twig', [
            'quack' => $quack,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="quack_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Quack $quack): Response
    {
        if ($this->isCsrfTokenValid('delete'.$quack->getId(), $request->request->get('_token'))) {
            $this->em->remove($quack);
            $this->em->flush();
            $this->addFlash('deleted', 'Your quack has been successfully deleted !');
        }

        return $this->redirectToRoute('quack_index');
    }
}
