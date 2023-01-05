<?php

namespace App\Controller;

use App\Form\SearchType;
use App\Repository\VoituresRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SearchController extends AbstractController
{
    #[Route('showroom/search', name: 'showroom_search')]
    public function searchCar(Request $request, VoituresRepository $voituresRepository): Response
    {
        $searchForm = $this->createForm(SearchType::class);
        $voitures = [];

        if ($searchForm->handleRequest($request)->isSubmitted() && $searchForm->isValid()) {
            $criteria = $searchForm->getData();
            $voitures = $voituresRepository->searchCar($criteria);
        }

        return $this->render('search/car.html.twig', [
            'search' => $searchForm->createView(),
            'voitures' => $voitures
        ]);
    }
}
