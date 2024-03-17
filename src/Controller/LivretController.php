<?php

namespace App\Controller;

use App\Entity\Livret;
use App\Form\LivretType;
use App\Repository\LivretRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/livret')]
class LivretController extends AbstractController
{
    #[Route('/', name: 'app_livret_index', methods: ['GET'])]
    public function index(LivretRepository $livretRepository): Response
    {
        return $this->render('livret/index.html.twig', [
            'livrets' => $livretRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_livret_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $livret = new Livret();
        $form = $this->createForm(LivretType::class, $livret);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $livret->setDemandeur($this->getUser());
            $livret->setConfirmation(false);
            $livret->setNumPorte(20);
            $entityManager->persist($livret);

            $entityManager->flush();

            return $this->redirectToRoute('app_livret_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('livret/new.html.twig', [
            'livret' => $livret,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_livret_show', methods: ['GET'])]
    public function show(Livret $livret): Response
    {
        return $this->render('livret/show.html.twig', [
            'livret' => $livret,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_livret_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Livret $livret, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(LivretType::class, $livret);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_livret_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('livret/edit.html.twig', [
            'livret' => $livret,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_livret_delete', methods: ['POST'])]
    public function delete(Request $request, Livret $livret, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$livret->getId(), $request->request->get('_token'))) {
            $entityManager->remove($livret);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_livret_index', [], Response::HTTP_SEE_OTHER);
    }
}
