<?php

namespace App\Controller;

use App\Entity\FlyOut;
use App\Form\FlyOutType;
use App\Repository\FlyOutRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/fly/out')]
class FlyOutController extends AbstractController
{
    #[Route('/', name: 'fly_out_index', methods: ['GET'])]
    public function index(FlyOutRepository $flyOutRepository): Response
    {
        return $this->render('fly_out/index.html.twig', [
            'fly_outs' => $flyOutRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'fly_out_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $flyOut = new FlyOut();
        $form = $this->createForm(FlyOutType::class, $flyOut);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($flyOut);
            $entityManager->flush();

            return $this->redirectToRoute('fly_out_index');
        }

        return $this->render('fly_out/new.html.twig', [
            'fly_out' => $flyOut,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'fly_out_show', methods: ['GET'])]
    public function show(FlyOut $flyOut): Response
    {
        return $this->render('fly_out/show.html.twig', [
            'fly_out' => $flyOut,
        ]);
    }

    #[Route('/{id}/edit', name: 'fly_out_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, FlyOut $flyOut): Response
    {
        $form = $this->createForm(FlyOutType::class, $flyOut);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('fly_out_index');
        }

        return $this->render('fly_out/edit.html.twig', [
            'fly_out' => $flyOut,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'fly_out_delete', methods: ['POST'])]
    public function delete(Request $request, FlyOut $flyOut): Response
    {
        if ($this->isCsrfTokenValid('delete'.$flyOut->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($flyOut);
            $entityManager->flush();
        }

        return $this->redirectToRoute('fly_out_index');
    }
}
