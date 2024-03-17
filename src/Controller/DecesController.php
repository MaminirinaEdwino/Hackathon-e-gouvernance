<?php

namespace App\Controller;

use App\Entity\Deces;
use App\Form\DecesType;
use App\Repository\DecesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/deces')]
class DecesController extends AbstractController
{
    #[Route('/', name: 'app_deces_index', methods: ['GET'])]
    public function index(DecesRepository $decesRepository): Response
    {
        return $this->render('deces/index.html.twig', [
            'deces' => $decesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_deces_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $dece = new Deces();
        $form = $this->createForm(DecesType::class, $dece);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dece->setConfirmation(false);
            $dece->setDemandeur($this->getUser());
            $dece->setNumPorte(23);
            $entityManager->persist($dece);
            $entityManager->flush();

            return $this->redirectToRoute('app_recup_fichier', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('deces/new.html.twig', [
            'dece' => $dece,
            'form' => $form,
        ]);
    }
    #[Route('/new/acte', name: 'app_deces_acte_new', methods: ['GET', 'POST'])]
    public function newacte(Request $request, EntityManagerInterface $entityManager): Response
    {
        $dece = new Deces();
        $form = $this->createForm(DecesType::class, $dece);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dece->setConfirmation(false);
            $dece->setDemandeurActe($this->getUser());
            $dece->setNumPorte(23);
            $entityManager->persist($dece);
            $entityManager->flush();

            return $this->redirectToRoute('app_recup_fichier', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('deces/new.html.twig', [
            'dece' => $dece,
            'form' => $form,
        ]);
    }
    #[Route('/{id}', name: 'app_deces_show', methods: ['GET'])]
    public function show(Deces $dece): Response
    {
        return $this->render('deces/show.html.twig', [
            'dece' => $dece,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_deces_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Deces $dece, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DecesType::class, $dece);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_deces_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('deces/edit.html.twig', [
            'dece' => $dece,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_deces_delete', methods: ['POST'])]
    public function delete(Request $request, Deces $dece, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$dece->getId(), $request->request->get('_token'))) {
            $entityManager->remove($dece);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_deces_index', [], Response::HTTP_SEE_OTHER);
    }
}
