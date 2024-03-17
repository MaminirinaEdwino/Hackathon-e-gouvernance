<?php

namespace App\Controller;

use App\Entity\Deces;
use App\Entity\Mariage;
use App\Entity\Naissance;
use App\Entity\Utilisateurs;
use App\Repository\UtilisateursRepository;
use Dompdf\Dompdf;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PdfController extends AbstractController
{
    #[Route('/pdf/declaration/naissance/{id}', name: 'app_declaration_naissance_pdf')]
    public function pdf_declaration_naissance(Naissance $naissance): Response
    {
        $html =  $this->renderView('pdf/declaration_naissance.html.twig', [
            'naissance'=>$naissance
        ]);
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->render();
        $id = $naissance->getId();
        $dompdf->stream("Acte de naissance $id", ["Attachment" => false]);
        return new Response('', 200, [
            'Content-Type' => 'application/pdf',
        ]);
    }
    #[Route('/pdf/mariage/{id}', name: 'app_mariage_pdf')]
    public function pdf_mariage(Mariage $mariage, UtilisateursRepository $utilisateursRepository): Response
    {
        $utilisateur = $utilisateursRepository->findBy(['id'=>$mariage->getDemandeur()]);
        $html =  $this->renderView('pdf/mariage.html.twig', [
            'mariage'=>$mariage,
            'partenaire'=>$utilisateursRepository->findBy(['partenaire'=>$utilisateur[0]->getPartenaire()])
        ]);
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->render();
        $id = $mariage->getId();
        $dompdf->stream("Acte de naissance $id", ["Attachment" => false]);
        return new Response('', 200, [
            'Content-Type' => 'application/pdf',
        ]);
    }
    #[Route('/pdf/dece/{id}', name: 'app_dece_pdf')]
    public function pdf_dece(Deces $mariage): Response
    {
        $html =  $this->renderView('pdf/dece.html.twig', [
            'dece'=>$mariage
        ]);
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->render();
        $id = $mariage->getId();
        $dompdf->stream("Acte de naissance $id", ["Attachment" => false]);
        return new Response('', 200, [
            'Content-Type' => 'application/pdf',
        ]);
    }
}
