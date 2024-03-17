<?php

namespace App\Controller;

use App\Entity\Utilisateurs;
use App\Form\Utilisateurs1Type;
use App\Repository\UtilisateursRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/employes')]
class EmployesController extends AbstractController
{
    #[Route('/', name: 'app_employes_index', methods: ['GET'])]
    public function index(UtilisateursRepository $utilisateursRepository): Response
    {
        return $this->render('employes/index.html.twig', [
            'utilisateurs' => $utilisateursRepository->findBy(['type'=>"employes"], []),
        ]);
    }

    #[Route('/new', name: 'app_employes_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager,
    UserPasswordHasherInterface $hasher): Response
    {
        $utilisateur = new Utilisateurs();
        $form = $this->createForm(Utilisateurs1Type::class, $utilisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $utilisateur->setProfession(1);
            $mdp = $utilisateur->getPassword();
            $utilisateur->setPassword($hasher->hashPassword($utilisateur, $mdp));
            $utilisateur->setType('employes');
            $utilisateur->setRoles(["ROLE_EMPLOYES"]);
            $utilisateur->setVivant(true);
            $entityManager->persist($utilisateur);
            $entityManager->flush();

            return $this->redirectToRoute('app_page_admin', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('employes/new.html.twig', [
            'utilisateur' => $utilisateur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_employes_show', methods: ['GET'])]
    public function show(Utilisateurs $utilisateur): Response
    {
        return $this->render('employes/show.html.twig', [
            'utilisateur' => $utilisateur,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_employes_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Utilisateurs $utilisateur, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Utilisateurs1Type::class, $utilisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_employes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('employes/edit.html.twig', [
            'utilisateur' => $utilisateur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_employes_delete', methods: ['POST'])]
    public function delete(Request $request, Utilisateurs $utilisateur, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$utilisateur->getId(), $request->request->get('_token'))) {
            $entityManager->remove($utilisateur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_employes_index', [], Response::HTTP_SEE_OTHER);
    }
}
