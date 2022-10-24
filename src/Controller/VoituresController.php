<?php

namespace App\Controller;
use App\Entity\Voitures;


use App\Form\VoituresType;
use App\Repository\VoituresRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route('/showroom/new',name:"voiture_create")]
    public function create(Request $request, EntityManagerInterface $manager): Response
    {
        $voiture = new Voitures();

        $form = $this->createForm(VoituresType::class, $voiture);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            foreach($voiture->getImages() as $image)
            {
                $image->setVoiture($voiture);
                $manager->persist($image);
            }

            $manager->persist($voiture);
            $manager->flush();

            $this->addFlash(
                'success',
                "L'annonce <strong>{$voiture->getMarque()} - {$voiture->getModele()}</strong> a bien été enregistrée!"
            );
            return $this->redirectToRoute('voitures_show', [
                'slug' => $voiture->getSlug()
            ]);
        }
        return $this->render("voitures/new.html.twig",[
            'myform' => $form->createView()
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
