<?php

namespace App\Controller;

use App\Entity\Livret;
use App\Repository\CertificationLegalisationRepository;
use App\Repository\DecesRepository;
use App\Repository\LivretRepository;
use App\Repository\MariageRepository;
use App\Repository\NaissanceRepository;
use App\Repository\UtilisateursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PageUtilisateursController extends AbstractController
{
    #[Route('/page/utilisateurs', name: 'app_page_utilisateurs')]
    public function index(
        UtilisateursRepository $utilisateursRepository,
        NaissanceRepository $naissanceRepository,
        MariageRepository $mariageRepository,
        LivretRepository $livretRepository,
        DecesRepository $decesRepository,
        CertificationLegalisationRepository $certificationLegalisationRepository
    ): Response
    {
        $utilisateur = $utilisateursRepository->findBy(['CIN'=>$this->getUser()->getUserIdentifier()]);

        return $this->render('page_utilisateurs/index.html.twig', [
            'declaration_naissances'=>$naissanceRepository->findBy(['demandeur'=>$utilisateur[0]->getId()]),
            'acte_de_naissances'=>$naissanceRepository->findBy(['demadeur_acte'=>$utilisateur[0]->getId()]),
            'declaration_deces'=>$decesRepository->findBy(['demandeur'=>$utilisateur[0]->getId()]),
            'acte_de_deces'=>$decesRepository->findBy(['demandeur_acte'=>$utilisateur[0]->getId()]),
            'certifications'=>$certificationLegalisationRepository->findBy(['demandeur'=>$utilisateur[0]->getId()]),
            'mariages'=>$mariageRepository->findBy(['demandeur'=>$utilisateur[0]->getId()]),
            'livret'=>$livretRepository->findBy(['demandeur'=>$utilisateur[0]->getId()])
        ]);
    }
}
