<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class DatingsController extends AbstractController
{
    #[Route('/datings', name: 'app_datings')]
    public function index(): Response
    {
        return $this->render('datings/index.html.twig', [
            'controller_name' => 'DatingsController',
        ]);
    }

    #[Route('/datings/add', name: 'app_datings_add')]
    public function add(): Response
    {
        return $this->render('datings/add.html.twig', [
            'controller_name' => 'DatingsController',
        ]);
    }
}
