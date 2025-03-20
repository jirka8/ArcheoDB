<?php

namespace App\Controller;

use App\Entity\Locations;
use App\Form\LocationType;
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
    public function index(): Response
    {
        return $this->render('locations/index.html.twig', [
            'controller_name' => 'LocationsController',
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
}
