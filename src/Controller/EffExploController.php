<?php

namespace App\Controller;

use App\Entity\EffExplo;
use App\Form\EffExploType;
use App\Repository\EffExploRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/eff/explo')]
class EffExploController extends AbstractController
{
    #[Route('/', name: 'eff_explo_index', methods: ['GET'])]
    public function index(EffExploRepository $effExploRepository): Response
    {
        return $this->render('eff_explo/index.html.twig', [
            'eff_explos' => $effExploRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'eff_explo_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $effExplo = new EffExplo();
        $form = $this->createForm(EffExploType::class, $effExplo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($effExplo);
            $entityManager->flush();

            return $this->redirectToRoute('eff_explo_index');
        }

        return $this->render('eff_explo/new.html.twig', [
            'eff_explo' => $effExplo,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'eff_explo_show', methods: ['GET'])]
    public function show(EffExplo $effExplo): Response
    {
        return $this->render('eff_explo/show.html.twig', [
            'eff_explo' => $effExplo,
        ]);
    }

    #[Route('/{id}/edit', name: 'eff_explo_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EffExplo $effExplo): Response
    {
        $form = $this->createForm(EffExploType::class, $effExplo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('eff_explo_index');
        }

        return $this->render('eff_explo/edit.html.twig', [
            'eff_explo' => $effExplo,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'eff_explo_delete', methods: ['POST'])]
    public function delete(Request $request, EffExplo $effExplo): Response
    {
        if ($this->isCsrfTokenValid('delete'.$effExplo->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($effExplo);
            $entityManager->flush();
        }

        return $this->redirectToRoute('eff_explo_index');
    }
}
