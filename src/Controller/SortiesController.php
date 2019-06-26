<?php

namespace App\Controller;

use App\Entity\Sorties;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SortiesController extends Controller
{
    /**
     * @Route("/home", name="sorties_home")
     */
    public function home()
    {
        return $this->render('sorties/home.html.twig', [
            'controller_name' => 'SortiesController',
        ]);
    }


    /**
     * @Route("/afficherSorties", name="sorties_afficher")
     */
    public function afficherSorties()
    {
        return $this->render('sorties/afficherSorties.html.twig', [
            'controller_name' => 'SortiesController',
        ]);
    }

    /**
     * @Route("/gererSorties", name="sorties_gerer")
     */
    public function gererSorties()
    {
        return $this->render('sorties/gererSorties.html.twig', [
            'controller_name' => 'SortiesController',
        ]);
    }

}
