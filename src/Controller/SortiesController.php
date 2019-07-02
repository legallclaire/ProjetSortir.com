<?php

namespace App\Controller;

use App\Entity\Lieux;
use App\Entity\Sites;
use App\Entity\Sorties;
use App\Entity\Villes;
use App\Form\SortieType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SortiesController extends Controller
{

    /**
     * @Route("/", name="sorties_home")
     */
    public function home(EntityManagerInterface $em, $ville=0)
    {

        $siteRepo = $this->getDoctrine()->getRepository(Sites::class);
        $listeSites = $siteRepo->findAll();
        $sortieRepo = $this->getDoctrine()->getRepository(Sorties::class);
        $listeSorties = $sortieRepo->findAll();

        return $this->render('sorties/afficherSorties.html.twig', [
            'controller_name' => 'SortiesController',
            'listeSites' => $listeSites,
            'listeSorties' => $listeSorties
        ]);
    }

    /**
     * @Route("/gererSorties", name="sorties_gerer")
     */
    public function gererSorties(EntityManagerInterface $em, Request $request, $ville=0)
    {

        $sortie = new Sorties();
//        $participant = $this->getUser();
//        $sortie->setNom($participant->getUser());
        $villesRepo = $this->getDoctrine()->getRepository(Villes::class);
        $listeVilles = $villesRepo->findAll();
        $lieuxRepo = $this->getDoctrine()->getRepository(Lieux::class);
        $listeLieux = $lieuxRepo->findByVille($ville);
        $sortieForm = $this->createForm(SortieType::class, $sortie);
        $sortieForm->handleRequest($request);
        if ($sortieForm->isSubmitted() && $sortieForm->isValid()) {
            $sortie->setDatedebut(new \DateTime());
            $em->persist($sortie);
            $em->flush();
            $this->addFlash("success", "Sortie créée !");
            return $this->redirectToRoute("sorties_afficher", [
                "id" => $sortie->getId(),
                "listeVilles => $listeVilles"]);
        }

        return $this->render('sorties/gererSorties.html.twig', [
            'sortieForm' => $sortieForm->createView(),
            'listeVilles' => $listeVilles,
            'villeSelected' => $ville,
            'lieuxDispo' => $listeLieux
        ]);
    }

}


