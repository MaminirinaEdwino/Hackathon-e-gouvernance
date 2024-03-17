<?php

namespace App\Controller;

use App\Entity\Naissance;
use App\Form\NaissanceType;
use App\Repository\NaissanceRepository;
use DateTimeInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


#[Route('/naissance')]
class NaissanceController extends AbstractController
{
    #[Route('/', name: 'app_naissance_index', methods: ['GET'])]
    public function index(NaissanceRepository $naissanceRepository): Response
    {
        return $this->render('naissance/index.html.twig', [
            'naissances' => $naissanceRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_naissance_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $naissance = new Naissance();
        $form = $this->createForm(NaissanceType::class, $naissance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $naissance->setConfirmer(false);
            $naissance->setDemandeur($this->getUser());
            $naissance->setNumPorte(24);
            $entityManager->persist($naissance);
            $entityManager->flush();

            return $this->redirectToRoute('app_recup_fichier', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('naissance/new.html.twig', [
            'naissance' => $naissance,
            'form' => $form,
        ]);
    }
    #[Route('/new/acte', name: 'app_naissance_acte_new', methods: ['GET', 'POST'])]
    public function newActe(Request $request, EntityManagerInterface $entityManager): Response
    {
        $naissance = new Naissance();
        $form = $this->createForm(NaissanceType::class, $naissance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $naissance->setConfirmer(false);
            $naissance->setDemadeurActe($this->getUser());
            $naissance->setNumPorte(24);
            $entityManager->persist($naissance);
            $entityManager->flush();

            return $this->redirectToRoute('app_recup_fichier', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('naissance/new.html.twig', [
            'naissance' => $naissance,
            'form' => $form,
        ]);
    }
    #[Route('/{id}', name: 'app_naissance_show', methods: ['GET'])]
    public function show(Naissance $naissance): Response
    {
        return $this->render('naissance/show.html.twig', [
            'naissance' => $naissance,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_naissance_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Naissance $naissance, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(NaissanceType::class, $naissance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_naissance_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('naissance/edit.html.twig', [
            'naissance' => $naissance,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_naissance_edit_employe', methods: ['GET', 'POST'])]
    public function editEmploye(Request $request, Naissance $naissance, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(NaissanceType::class, $naissance);
        $form->handleRequest($request);
        $form->remove('nom');
        $form->remove('prenom');
        $form->remove('sex');
        $form->remove('date_naissance');
        $form->remove('nom');
        $form->remove('lieu_naissance');
        $form->remove('pere');
        $form->remove('mere');
        $form->add('fichier_retour');
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_naissance_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('naissance/edit.html.twig', [
            'naissance' => $naissance,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_naissance_delete', methods: ['POST'])]
    public function delete(Request $request, Naissance $naissance, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$naissance->getId(), $request->request->get('_token'))) {
            $entityManager->remove($naissance);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_naissance_index', [], Response::HTTP_SEE_OTHER);
    }
}
