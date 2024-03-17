<?php

namespace App\Controller;

use App\Entity\Porte;
use App\Form\PorteType;
use App\Repository\PorteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/porte')]
class PorteController extends AbstractController
{
    #[Route('/', name: 'app_porte_index', methods: ['GET'])]
    public function index(PorteRepository $porteRepository): Response
    {
        return $this->render('porte/index.html.twig', [
            'portes' => $porteRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_porte_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $porte = new Porte();
        $form = $this->createForm(PorteType::class, $porte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($porte);
            $entityManager->flush();

            return $this->redirectToRoute('app_porte_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('porte/new.html.twig', [
            'porte' => $porte,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_porte_show', methods: ['GET'])]
    public function show(Porte $porte): Response
    {
        return $this->render('porte/show.html.twig', [
            'porte' => $porte,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_porte_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Porte $porte, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PorteType::class, $porte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_porte_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('porte/edit.html.twig', [
            'porte' => $porte,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_porte_delete', methods: ['POST'])]
    public function delete(Request $request, Porte $porte, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$porte->getId(), $request->request->get('_token'))) {
            $entityManager->remove($porte);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_porte_index', [], Response::HTTP_SEE_OTHER);
    }
}
