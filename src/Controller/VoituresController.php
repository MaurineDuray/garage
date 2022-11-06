<?php

namespace App\Controller;

use App\Entity\Pictures;
use App\Entity\Voitures;
use App\Form\VoituresType;
use App\Repository\VoituresRepository;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class VoituresController extends AbstractController
{
    /**Afficher l'ensemble des voitures du showroom*/
    #[Route('/showroom', name: 'voitures_showroom')]
    public function index(VoituresRepository $repo): Response
    {
        $voitures = $repo->findAll();

        return $this->render('voitures/index.html.twig', [
            'voitures' => $voitures,
        ]);
    }

    /**
     * Permet d'afficher le formulaire de création de l'ajout d'un véhicule au showroom
     *
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    #[Route('/showroom/new',name:"voiture_create")]
    public function create(Request $request, EntityManagerInterface $manager): Response
    {
        $voiture = new Voitures();

        $form = $this->createForm(VoituresType::class, $voiture);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            /**Gestion de l'image de couverture */
            $file = $form['image']->getData();
            if(!empty($file))
            {
                $originalFilename = pathinfo($file->getClientOriginalName(),PATHINFO_FILENAME);
                $safeFilename =transliterator_transliterate('Any-Latin;Latin-ASCII;[^A-Za-z0-9_]remove;Lower()', $originalFilename);
                $newFilename =$safeFilename."-".uniqid().".".$file->guessExtension();
                try{
                    $file->move(
                        $this->getParameter('uploads_directory'),
                        $newFilename
                    );
                }catch(FileException $e)
                {
                    return $e->getMessage();
                }
                $voiture->setImage($newFilename);
            }

            /**Gestion des images de la galerie */
            
            foreach($voiture->getPictures() as $picture){
                   
                $picture->setVoitureId($voiture);
                $manager->persist($picture);   
            }
            /*** */    
                
            $manager->persist($voiture);
            $manager->flush();

            /**
             * Message flash pour alerter l'utilisateur de l'état de la tâche
             */
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

    /**
     * Permet d'afficher une voiture en particulier et ses détails(fiche info)
     * placée après la fonction pour créer sinon la route peux prendre le /new pour un slug (et ne pas le trouver)
     */

    #[Route('/showroom/{slug}', name:"voitures_show")]
    public function show(string $slug, voitures $voiture):Response
    {
        return $this->render('voitures/show.html.twig',[
            'voiture'=> $voiture
        ]);
    }
}
