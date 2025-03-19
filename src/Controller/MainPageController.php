<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

final class MainPageController extends AbstractController
{
    #[Route('/', name: 'app_main_page')]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function index(): Response
    {
        return $this->render('main_page/index.html.twig', [
            'controller_name' => 'MainPageController',
        ]);
    }
}
