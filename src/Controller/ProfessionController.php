<?php

namespace App\Controller;

use App\Entity\Profession;
use App\Form\ProfessionType;
use App\Repository\ProfessionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/profession')]
class ProfessionController extends AbstractController
{
    #[Route('/', name: 'app_profession_index', methods: ['GET'])]
    public function index(ProfessionRepository $professionRepository): Response
    {
        return $this->render('profession/index.html.twig', [
            'professions' => $professionRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_profession_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $profession = new Profession();
        $form = $this->createForm(ProfessionType::class, $profession);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($profession);
            $entityManager->flush();

            return $this->redirectToRoute('app_profession_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('profession/new.html.twig', [
            'profession' => $profession,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_profession_show', methods: ['GET'])]
    public function show(Profession $profession): Response
    {
        return $this->render('profession/show.html.twig', [
            'profession' => $profession,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_profession_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Profession $profession, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProfessionType::class, $profession);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_profession_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('profession/edit.html.twig', [
            'profession' => $profession,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_profession_delete', methods: ['POST'])]
    public function delete(Request $request, Profession $profession, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$profession->getId(), $request->request->get('_token'))) {
            $entityManager->remove($profession);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_profession_index', [], Response::HTTP_SEE_OTHER);
    }
}
