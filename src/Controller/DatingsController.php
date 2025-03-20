<?php

namespace App\Controller;

use App\Repository\DatingsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class DatingsController extends AbstractController
{
    #[Route('/datings', name: 'app_datings')]
    public function index(
        DatingsRepository $datings
    ): Response
    {
        $items = $datings->findBy(['parent' => null]);

        return $this->render('datings/index.html.twig', [
            'items' => $items,
            'edit_action' => 'app_datings_edit',
            'delete_action' => 'app_datings_delete',
        ]);
    }

    #[Route('/datings/add', name: 'app_datings_add')]
    public function add(): Response
    {
        return $this->render('datings/add.html.twig', [
            'controller_name' => 'DatingsController',
        ]);
    }

    #[Route('/datings/edit/{id}', name: 'app_datings_edit')]
    public function edit(): Response
    {
        return $this->render('datings/edit.html.twig', [
            'controller_name' => 'DatingsController',
        ]);
    }

    #[Route('/datings/delete/{id}', name: 'app_datings_delete')]
    public function delete(): Response
    {
        return $this->render('datings/delete.html.twig', [
            'controller_name' => 'DatingsController',
        ]);
    }
}
