<?php

namespace App\Controller;

use App\Entity\Usine;
use App\Form\UsineType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UsineController extends AbstractController
{
    #[Route('/usine', name: 'usine_index', methods: ['GET'])]
    public function index(EntityManagerInterface $em): Response
    {
        $usines = $em->getRepository(Usine::class)->findAll();
        return $this->render('usine/index.html.twig', ['usines' => $usines]);
    }

    #[Route('/usine/new', name: 'usine_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $usine = new Usine();
        $form = $this->createForm(UsineType::class, $usine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($usine);
            $em->flush();

            return $this->redirectToRoute('usine_index');
        }

        return $this->render('usine/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/usine/{id}', name: 'usine_show', methods: ['GET'])]
    public function show(Usine $usine): Response
    {
        return $this->render('usine/show.html.twig', ['usine' => $usine]);
    }

    #[Route('/usine/{id}/edit', name: 'usine_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Usine $usine, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(UsineType::class, $usine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->redirectToRoute('usine_index');
        }

        return $this->render('usine/edit.html.twig', [
            'usine' => $usine,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/usine/{id}', name: 'usine_delete', methods: ['POST'])]
    public function delete(Request $request, Usine $usine, EntityManagerInterface $em): Response
    {
        if ($this->isCsrfTokenValid('delete' . $usine->getId(), $request->request->get('_token'))) {
            $em->remove($usine);
            $em->flush();
        }

        return $this->redirectToRoute('usine_index');
    }
}
