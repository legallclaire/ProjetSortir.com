<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class SortiesController extends Controller
{
    /**
     * @Route("/home", name="sorties_home")
     */
    public function index()
    {
        return $this->render('sorties/home.html.twig', [
            'controller_name' => 'SortiesController',
        ]);
    }
}
