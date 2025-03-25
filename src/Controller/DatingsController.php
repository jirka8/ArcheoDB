<?php

namespace App\Controller;

use App\Entity\Datings;
use App\Form\DatingType;
use App\Repository\DatingsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
    public function add(
        Request $request,
        EntityManagerInterface $entityManager
    ): Response
    {
        $form = $this->createForm(DatingType::class, new Datings());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dating = $form->getData();
            $entityManager->persist($dating);
            $entityManager->flush();

            $this->addFlash('success', 'Datace byla úspěšně přidána.');

            return $this->redirectToRoute('app_datings');
        }

        return $this->render('datings/add.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/datings/edit/{id}', name: 'app_datings_edit')]
    public function edit(
        Datings $dating,
        Request $request,
        EntityManagerInterface $entityManager
    ): Response
    {
        $form = $this->createForm(DatingType::class, $dating);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dating = $form->getData();
            $entityManager->persist($dating);
            $entityManager->flush();

            $this->addFlash('success', 'Datace byla úspěšně upravena.');

            return $this->redirectToRoute('app_datings');
        }

        return $this->render('datings/edit.html.twig', [
            'form' => $form,
            'dating' => $dating,
        ]);
    }

    #[Route('/datings/delete/{id}', name: 'app_datings_delete')]
    public function delete(
        Datings $dating,
        EntityManagerInterface $entityManager
    ): Response
    {
        $entityManager->remove($dating);
        $entityManager->flush();

        $this->addFlash('success', 'Datace byla úspěšně smazána.');

        return $this->redirectToRoute('app_datings');
    }
}
