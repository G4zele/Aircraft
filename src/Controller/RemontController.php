<?php

namespace App\Controller;

use App\Entity\Remont;
use App\Form\RemontType;
use App\Repository\RemontRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/remont')]
class RemontController extends AbstractController
{
    #[Route('/', name: 'remont_index', methods: ['GET'])]
    public function index(RemontRepository $remontRepository): Response
    {
        return $this->render('remont/index.html.twig', [
            'remonts' => $remontRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'remont_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $remont = new Remont();
        $form = $this->createForm(RemontType::class, $remont);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($remont);
            $entityManager->flush();

            return $this->redirectToRoute('remont_index');
        }

        return $this->render('remont/new.html.twig', [
            'remont' => $remont,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'remont_show', methods: ['GET'])]
    public function show(Remont $remont): Response
    {
        return $this->render('remont/show.html.twig', [
            'remont' => $remont,
        ]);
    }

    #[Route('/{id}/edit', name: 'remont_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Remont $remont): Response
    {
        $form = $this->createForm(RemontType::class, $remont);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('remont_index');
        }

        return $this->render('remont/edit.html.twig', [
            'remont' => $remont,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'remont_delete', methods: ['POST'])]
    public function delete(Request $request, Remont $remont): Response
    {
        if ($this->isCsrfTokenValid('delete'.$remont->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($remont);
            $entityManager->flush();
        }

        return $this->redirectToRoute('remont_index');
    }
}
