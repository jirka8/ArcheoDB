<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CategoriesController extends AbstractController
{
    #[Route('/categories', name: 'app_categories')]
    public function index(): Response
    {
        return $this->render('categories/index.html.twig', [
            'controller_name' => 'CategoriesController',
        ]);
    }

    #[Route('/categories/add', name: 'app_categories_add')]
    public function add(): Response
    {
        return $this->render('categories/add.html.twig', [
            'controller_name' => 'CategoriesController',
        ]);
    }
}
