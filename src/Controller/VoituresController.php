<?php

namespace App\Controller;
use App\Entity\Voitures;


use App\Repository\VoituresRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class VoituresController extends AbstractController
{
    /**Afficher l'ensemble des voitures */
    #[Route('/showroom', name: 'voitures_showroom')]
    public function index(VoituresRepository $repo): Response
    {
        $voitures = $repo->findAll();

        return $this->render('voitures/index.html.twig', [
            'voitures' => $voitures,
        ]);
    }

    #[Route('/showroom/{slug}', name:"voitures_show")]
    public function show(string $slug, voitures $voiture):Response
    {
        return $this->render('voitures/show.html.twig',[
            'voiture'=> $voiture
        ]);
    }
}
