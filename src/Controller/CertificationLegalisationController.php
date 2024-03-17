<?php

namespace App\Controller;

use App\Entity\CertificationLegalisation;
use App\Form\CertificationLegalisationType;
use App\Repository\CertificationLegalisationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/certification/legalisation')]
class CertificationLegalisationController extends AbstractController
{
    #[Route('/', name: 'app_certification_legalisation_index', methods: ['GET'])]
    public function index(CertificationLegalisationRepository $certificationLegalisationRepository): Response
    {
        return $this->render('certification_legalisation/index.html.twig', [
            'certification_legalisations' => $certificationLegalisationRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_certification_legalisation_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager,
    SluggerInterface $slugger): Response
    {
        $certificationLegalisation = new CertificationLegalisation();
        $form = $this->createForm(CertificationLegalisationType::class, $certificationLegalisation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pdf = $form->get('non_legalise')->getData();

            if ($pdf){
                $originalFilename = pathinfo($pdf->getClientOriginalName(), flags: PATHINFO_FILENAME);
                $safe_Filename = $slugger->slug($originalFilename);
                $newFilename = $safe_Filename.'-'.uniqid().'.'.$pdf->guessExtension();
                try {
                    $pdf->move(
                        $this->getParameter('pdf'),
                        $newFilename
                    );
                }catch (FileException){

                }
                $certificationLegalisation->setNonLegalise($newFilename);
            }
            $certificationLegalisation->setDemandeur($this->getUser());
            $certificationLegalisation->setConfirmation(false);
            $entityManager->persist($certificationLegalisation);
            $entityManager->flush();

            return $this->redirectToRoute('app_recup_fichier', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('certification_legalisation/new.html.twig', [
            'certification_legalisation' => $certificationLegalisation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_certification_legalisation_show', methods: ['GET'])]
    public function show(CertificationLegalisation $certificationLegalisation): Response
    {
        return $this->render('certification_legalisation/show.html.twig', [
            'certification_legalisation' => $certificationLegalisation,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_certification_legalisation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CertificationLegalisation $certificationLegalisation, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CertificationLegalisationType::class, $certificationLegalisation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_certification_legalisation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('certification_legalisation/edit.html.twig', [
            'certification_legalisation' => $certificationLegalisation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_certification_legalisation_delete', methods: ['POST'])]
    public function delete(Request $request, CertificationLegalisation $certificationLegalisation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$certificationLegalisation->getId(), $request->request->get('_token'))) {
            $entityManager->remove($certificationLegalisation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_certification_legalisation_index', [], Response::HTTP_SEE_OTHER);
    }
}
