<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Form\CategoryType;
use App\Repository\CategoriesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class CategoriesController extends AbstractController
{
    #[Route('/categories', name: 'app_categories')]
    public function index(
        CategoriesRepository $categories
    ): Response
    {
        $items = $categories->findBy(['parent' => null]);

        return $this->render('categories/index.html.twig', [
            'items' => $items,
            'edit_action' => 'app_categories_edit',
            'delete_action' => 'app_categories_delete',
        ]);
    }

    #[Route('/categories/add', name: 'app_categories_add')]
    public function add(
        Request $request,
        EntityManagerInterface $entityManager
    ): Response
    {
        $form = $this->createForm(CategoryType::class, new Categories());
        $form->handleRequest($request);

        return $this->render('categories/add.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/categories/edit/{id}', name: 'app_categories_edit')]
    public function edit(): Response
    {
        return $this->render('categories/edit.html.twig', [
            'controller_name' => 'CategoriesController',
        ]);
    }

    #[Route('/categories/delete/{id}', name: 'app_categories_delete')]
    public function delete(): Response
    {
        return $this->render('categories/delete.html.twig', [
            'controller_name' => 'CategoriesController',
        ]);
    }
}
