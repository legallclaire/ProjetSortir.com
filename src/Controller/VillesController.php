<?php

namespace App\Controller;


use App\Entity\Villes;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin", name="admin_")
 */
class VillesController extends Controller
{
    /**
     * @Route("/gererVilles", name="villes_gerer")
     */
    public function gererVilles(Request $request)
    {
        if (!$this->isGranted("ROLE_ADMIN")){
            throw new AccessDeniedException("Accès interdit !");
        }

        $villesRepo = $this->getDoctrine()->getRepository(Villes::class);
        $villes=$villesRepo->findAll();
            if ($villes==null){

                throw $this->createNotFoundException("Aucune ville");
            }


        return $this->render('villes/gererVilles.html.twig', [
            'villes' => $villes
        ]);
    }
}
