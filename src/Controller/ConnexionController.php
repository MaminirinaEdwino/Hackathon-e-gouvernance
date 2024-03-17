<?php

namespace App\Controller;

use App\Entity\CertificationLegalisation;
use App\Entity\Naissance;
use App\Entity\Utilisateurs;
use App\Repository\CertificationLegalisationRepository;
use App\Repository\DecesRepository;
use App\Repository\LivretRepository;
use App\Repository\MariageRepository;
use App\Repository\NaissanceRepository;
use App\Repository\UtilisateursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ConnexionController extends AbstractController
{
    #[Route('/connexion/success', name: 'app_connexion')]
    public function index(): Response
    {
        $user = $this->getUser();
        $role = $user->getRoles();
        
        //dd($role[0]);
        if ($role[0] == "ROLE_ADMIN") {
            return $this->redirectToRoute('app_page_admin');
        }
        if ($role[0] == "ROLE_USER") {
            return $this->redirectToRoute('app_page_utilisateurs');
        }
        if ($role[0] == "ROLE_EMPLOYES") {
            return $this->redirectToRoute('app_page_employes', [
            ]);
        }
    }
}
