<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class ProfilController extends Controller
{
    /**
     * @Route("/gererProfil", name="profil_gerer")
     */
    public function gererProfil()
    {
        return $this->render('profil/gererProfil.html.twig');
    }

    /**
     * @Route("/afficherProfil", name="profil_afficher")
     */
    public function afficherProfil()
    {
        return $this->render('profil/afficherProfil.html.twig');
    }
}
