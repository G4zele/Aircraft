<?php

namespace App\Controller;

use App\Entity\DateInterval;
use App\Form\DateIntervalType;
use App\Repository\DateIntervalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/date/interval')]
class DateIntervalController extends AbstractController
{
    #[Route('/', name: 'date_interval_index', methods: ['GET'])]
    public function index(DateIntervalRepository $dateIntervalRepository): Response
    {
        return $this->render('date_interval/index.html.twig', [
            'date_intervals' => $dateIntervalRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'date_interval_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $dateInterval = new DateInterval();
        $form = $this->createForm(DateIntervalType::class, $dateInterval);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($dateInterval);
            $entityManager->flush();

            return $this->redirectToRoute('date_interval_index');
        }

        return $this->render('date_interval/new.html.twig', [
            'date_interval' => $dateInterval,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'date_interval_show', methods: ['GET'])]
    public function show(DateInterval $dateInterval): Response
    {
        return $this->render('date_interval/show.html.twig', [
            'date_interval' => $dateInterval,
        ]);
    }

    #[Route('/{id}/edit', name: 'date_interval_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, DateInterval $dateInterval): Response
    {
        $form = $this->createForm(DateIntervalType::class, $dateInterval);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('date_interval_index');
        }

        return $this->render('date_interval/edit.html.twig', [
            'date_interval' => $dateInterval,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'date_interval_delete', methods: ['POST'])]
    public function delete(Request $request, DateInterval $dateInterval): Response
    {
        if ($this->isCsrfTokenValid('delete'.$dateInterval->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($dateInterval);
            $entityManager->flush();
        }

        return $this->redirectToRoute('date_interval_index');
    }
}
