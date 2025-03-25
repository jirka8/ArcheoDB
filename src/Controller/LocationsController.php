<?php

namespace App\Controller;

use App\Entity\Locations;
use App\Form\LocationType;
use App\Repository\LocationsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class LocationsController extends AbstractController
{
    #[Route('/locations', name: 'app_locations')]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function index(
        LocationsRepository $locations
    ): Response
    {
        $locs = $locations->findAll();
        
        return $this->render('locations/index.html.twig', [
            'locations' => $locs,
        ]);
    }

    #[Route('/locations/add', name: 'app_locations_add')]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function add(
        Request $request,
        EntityManagerInterface $entityManager
    ): Response
    {
        $form = $this->createForm(LocationType::class, new Locations());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $location = $form->getData();
            $location->setCreator($this->getUser());
            $entityManager->persist($location);
            $entityManager->flush();

            $this->addFlash('success', 'Lokalita byla úspěšně přidána.');

            return $this->redirectToRoute('app_locations');
        }

        return $this->render('locations/add.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/locations/edit/{id}', name: 'app_locations_edit')]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function edit(
        Locations $location,
        Request $request,
        EntityManagerInterface $entityManager
    ): Response
    {
        $form = $this->createForm(LocationType::class, $location);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $location = $form->getData();
            $entityManager->persist($location);
            $entityManager->flush();

            $this->addFlash('success', 'Lokalita byla úspěšně upravena.');

            return $this->redirectToRoute('app_locations');
        }

        return $this->render('locations/edit.html.twig', [
            'form' => $form,
            'location' => $location,
        ]);
    }

    #[Route('/locations/delete/{id}', name: 'app_locations_delete')]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function delete(
        Locations $location,
        EntityManagerInterface $entityManager
    ): Response
    {
        $entityManager->remove($location);
        $entityManager->flush();

        $this->addFlash('success', 'Lokalita byla úspěšně smazána.');

        return $this->redirectToRoute('app_locations');
    }
}
