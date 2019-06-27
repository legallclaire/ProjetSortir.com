<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/admin", name="admin_")
 */
class SitesController extends Controller
{
    /**
     * @Route("/gererSites", name="sites_gerer")
     */
    public function gererSites()
    {
        if (!$this->isGranted("ROLE_ADMIN")){
            throw new AccessDeniedException("Accès interdit !");
        }

        return $this->render('sites/gererSites.html.twig', [
            'controller_name' => 'SitesController',
        ]);
    }
}
