<?php

namespace App\Controller;

use App\Entity\Mariage;
use App\Form\MariageType;
use App\Repository\MariageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/mariage')]
class MariageController extends AbstractController
{
    #[Route('/', name: 'app_mariage_index', methods: ['GET'])]
    public function index(MariageRepository $mariageRepository): Response
    {
        return $this->render('mariage/index.html.twig', [
            'mariages' => $mariageRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_mariage_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $mariage = new Mariage();
        $form = $this->createForm(MariageType::class, $mariage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $mariage->setConfirmation(false);
            $mariage->setDemandeur($this->getUser());
            $mariage->setNumPorte(20);
            $entityManager->persist($mariage);
            $entityManager->flush();

            return $this->redirectToRoute('app_recup_fichier', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('mariage/new.html.twig', [
            'mariage' => $mariage,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_mariage_show', methods: ['GET'])]
    public function show(Mariage $mariage): Response
    {
        return $this->render('mariage/show.html.twig', [
            'mariage' => $mariage,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_mariage_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Mariage $mariage, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MariageType::class, $mariage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_recup_fichier', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('mariage/edit.html.twig', [
            'mariage' => $mariage,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_mariage_delete', methods: ['POST'])]
    public function delete(Request $request, Mariage $mariage, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$mariage->getId(), $request->request->get('_token'))) {
            $entityManager->remove($mariage);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_mariage_index', [], Response::HTTP_SEE_OTHER);
    }
}
