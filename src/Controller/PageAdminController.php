<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PageAdminController extends AbstractController
{
    #[Route('/page/admin', name: 'app_page_admin')]
    public function index(): Response
    {
        return $this->render('page_admin/index.html.twig');
    }
}
