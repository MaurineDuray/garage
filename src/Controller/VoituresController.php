<?php

namespace App\Controller;

use App\Entity\Pictures;
use App\Entity\Voitures;
use App\Form\SearchType;
use App\Form\VoituresType;
use App\Service\PaginationService;
use App\Repository\VoituresRepository;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class VoituresController extends AbstractController
{

    // /**
    //  * Affiche l'ensemble des voitures du showroom sans recherche
    //  *
    //  * @param VoituresRepository $repo
    //  * @return Response
    //  */
    // #[Route('/showroom', name: 'voitures_showroom')]
    // public function index(VoituresRepository $repo): Response
    // {
    //     $voitures = $repo->findAll();



    //     return $this->render('voitures/index.html.twig', [
    //         'voitures' => $voitures,

    //     ]);
    // }


    // /**
    //  * Page d'accueil avec barre de recherche
    //  *
    //  * @param Request $request
    //  * @param VoituresRepository $voituresRepository
    //  * @return Response
    //  */
    // #[Route('/showroom/{page<\d+>?1}', name: 'voitures_showroom')]
    // public function searchCar(Request $request, VoituresRepository $voituresRepository): Response
    // {
    //     $searchForm = $this->createForm(SearchType::class);
    //     $voitures = [];

    //     if ($searchForm->handleRequest($request)->isSubmitted() && $searchForm->isValid()) {
    //         $criteria = $searchForm['search']->getData();
    //         $voitures = $voituresRepository->findVoitures($criteria);
    //     } else {
    //         $voitures = $voituresRepository->findAll();
    //     }
    //     return $this->render('voitures/index.html.twig', [
    //         'search' => $searchForm->createView(),
    //         'voitures' => $voitures,

    //     ]);
    // }

    /**
     * Page d'accueil avec barre de recherche
     *
     * @param Request $request
     * @param VoituresRepository $voituresRepository
     * @return Response
     */
    #[Route('/showroom/{page<\d+>?1}', name: 'voitures_showroom')]
    public function searchCar(Request $request, PaginationService $pagination, $page, VoituresRepository $repo): Response
    {


        $searchForm = $this->createForm(SearchType::class);



        if ($searchForm->handleRequest($request)->isSubmitted() && $searchForm->isValid()) {
            $criteria = $searchForm['search']->getData();
            $voitures = $repo->findVoitures($criteria);

            return $this->render('voitures/index.html.twig', [
                'search' => $searchForm->createView(),
                'pagination' => $pagination,
                'voitures'=>$voitures
            ]);

        } else {
            $pagination->setEntityClass(Voitures::class)
                ->setPage($page)
                ->setLimit(6);

                return $this->render('voitures/index.html.twig', [
                    'search' => $searchForm->createView(),
                    'pagination' => $pagination,
                   
                ]);
        }



        
    }


    /**
     * Permet d'afficher le formulaire de cr??ation de l'ajout d'un v??hicule au showroom
     *
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    #[Route('/showroom/new', name: "voiture_create")]
    #[IsGranted("ROLE_USER")]
    public function create(Request $request, EntityManagerInterface $manager): Response
    {
        $voiture = new Voitures();

        $form = $this->createForm(VoituresType::class, $voiture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /**Gestion de l'image de couverture */
            $file = $form['image']->getData();
            if (!empty($file)) {
                $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = transliterator_transliterate('Any-Latin;Latin-ASCII;[^A-Za-z0-9_]remove;Lower()', $originalFilename);
                $newFilename = $safeFilename . "-" . uniqid() . "." . $file->guessExtension();
                try {
                    $file->move(
                        $this->getParameter('uploads_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    return $e->getMessage();
                }
                $voiture->setImage($newFilename);
            }

            /**Gestion des images de la galerie */

            foreach ($voiture->getPictures() as $picture) {

                $picture->setVoitureId($voiture);
                $manager->persist($picture);
            }
            /*** */

            $manager->persist($voiture);
            $manager->flush();

            /**
             * Message flash pour alerter l'utilisateur de l'??tat de la t??che
             */
            $this->addFlash(
                'success',
                "L'annonce <strong>{$voiture->getMarque()} - {$voiture->getModele()}</strong> a bien ??t?? enregistr??e!"
            );

            return $this->redirectToRoute('voitures_show', [
                'slug' => $voiture->getSlug()
            ]);
        }

        return $this->render("voitures/new.html.twig", [
            'myform' => $form->createView()
        ]);
    }

    /**
     * Permet d'afficher une voiture en particulier et ses d??tails(fiche info)
     * plac??e apr??s la fonction pour cr??er sinon la route peux prendre le /new pour un slug (et ne pas le trouver)
     */

    #[Route('/showroom/{slug}', name: "voitures_show")]
    public function show(string $slug, voitures $voiture): Response
    {
        return $this->render('voitures/show.html.twig', [
            'voiture' => $voiture
        ]);
    }
}
