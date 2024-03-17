<?php

namespace App\Controller;

use App\Entity\CertificationLegalisation;
use App\Entity\Deces;
use App\Entity\Livret;
use App\Entity\Mariage;
use App\Entity\Naissance;
use App\Form\CertificationLegalisationType;
use App\Repository\CertificationLegalisationRepository;
use App\Repository\DecesRepository;
use App\Repository\LivretRepository;
use App\Repository\MariageRepository;
use App\Repository\NaissanceRepository;
use App\Repository\UtilisateursRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Dompdf\Dompdf;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class PageEmployesController extends AbstractController
{
    #[Route('/page/employes', name: 'app_page_employes', methods:['POST', 'GET'])]
    public function index(
    UtilisateursRepository $utilisateursRepository,
    NaissanceRepository $naissanceRepository,
    MariageRepository $mariageRepository,
    LivretRepository $livretRepository,
    DecesRepository $decesRepository,
    CertificationLegalisationRepository $certificationLegalisationRepository
    ): Response
    {
        $employe = $utilisateursRepository->findBy(['CIN'=>$this->getUser()->getUserIdentifier()]);
        if ($employe[0]->getPorte() == "PORTE 24") {
            /**
             * ny ato amin ny porte 24 miandraikitra ny naissance sy ny certification ihany 
             */
            $declaration_naissance = $naissanceRepository->findBy(['num_porte'=>24,'demadeur_acte'=>null, 'confirmer'=>false], ['id'=>'desc']);
            $acte_naissance = $naissanceRepository->findBy(['num_porte'=>24, 'demandeur'=>null, 'confirmer'=>false], ['id'=>'desc']);
            $certifation = $certificationLegalisationRepository->findBy(['confirmation'=>false], ['id'=>'desc']);
            return $this->render('page_employes/index.html.twig', [
                'employe'=>$employe,
                'declarations'=>$declaration_naissance,
                'demande_actes'=>$acte_naissance,
                'certifications'=>$certifation
            ]);
        }


        if ($employe[0]->getPorte() == "PORTE 23") {
            /**
             * ny porte 23 resaka dece irery ihany 
             */
            $declaration_dece = $decesRepository->findBy(['num_porte'=>23, 'demandeur_acte'=>null, 'confirmation'=>false], ['id'=>'desc']);
            $acte_dece = $decesRepository->findBy(['num_porte'=>23, 'demandeur'=>null, 'confirmation'=>false], ['id'=>'desc']);
            return $this->render('page_employes/index.html.twig', [
                'employe'=>$employe,
                'declarations_dece'=>$declaration_dece,
                'demande_actes_dece'=>$acte_dece
            ]);
        }
        if ($employe[0]->getPorte() == "PORTE 20") {
            /**
             * ny porte 20 resaka mariage fotsiny
             */
            $mariage = $mariageRepository->findBy(['num_porte'=>20, 'confirmation'=>false], ['id'=>'desc']);
            $livret = $livretRepository->findBy(['num_porte'=>20, 'confirmation'=>false], ['id'=>'desc']);
            return $this->render('page_employes/index.html.twig', [
                'employe'=>$employe,
                'demande_acte_mariages'=>$mariage,
                'demande_livrets'=>$livret
            ]);
        }
    }

    #[Route(path:'/page/employe/declaration/naissance/{id}', name:'app_confirmer_declaration_naissance')]
    public function confirmer_declaration_naissance(Naissance $naissance, EntityManagerInterface $entityManager){
        $naissance->setConfirmer(true);
        $entityManager->persist($naissance);
        $entityManager->flush();
        return $this->redirectToRoute('app_page_employes');
    }
    #[Route(path:'/page/employe/acte/mariage/{id}', name:'app_confirmer_acte_mariage')]
    public function confirmer_acte_mariage(Mariage $mariage, EntityManagerInterface $entityManager){
        $mariage->setConfirmation(true);
        $entityManager->persist($mariage);
        $entityManager->flush();
        return $this->redirectToRoute('app_page_employes');
    }
    #[Route(path:'/page/employe/livret/{id}', name:'app_confirmer_livret')]
    public function confirmer_livret(Livret $livret, EntityManagerInterface $entityManager){
        $livret->setConfirmation(true);
        $entityManager->persist($livret);
        $entityManager->flush();
        return $this->redirectToRoute('app_page_employes');
    }
    #[Route(path:'/page/employe/confirmer/declaration/dece/{id}', name:'app_confirmer_dece')]
    public function confirmer_declaration_dece(Deces $deces, EntityManagerInterface $entityManager){
        $deces->setConfirmation(true);
        $entityManager->persist($deces);
        $entityManager->flush();
        return $this->redirectToRoute('app_page_employes');
    }
    #[Route(path:'/page/employe/certification/{id}', name:'app_details_demande_certification', methods:['POST', 'GET'])]
    public function confirmer_certification(CertificationLegalisation $certifation, 
    EntityManagerInterface $entityManager, Request $request, SluggerInterface $slugger){
        
        $form = $this->createForm(CertificationLegalisationType::class);
        $form->remove('non_legalise');
        $form->add('legalise', FileType::class);
        $form->add('enregistrer', SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $pdf = $form->get('legalise')->getData();

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
                $certifation->setLegalise($newFilename);
            }
            $certifation->setConfirmation(true);
            $entityManager->persist($certifation);
            $entityManager->flush();

            return $this->redirectToRoute('app_page_employes', [], Response::HTTP_SEE_OTHER);
        }
        $certifation->setConfirmation(true);
        $entityManager->persist($certifation);
        $entityManager->flush();
        return $this->render('page_employes/certification.html.twig',[
            'form'=>$form,
            'certification'=>$certifation
        ]);
    }
}
