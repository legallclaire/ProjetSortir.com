<?php

namespace App\Controller;

use App\Entity\Sites;
use App\Form\SitesType;
use Symfony\Component\HttpFoundation\Request;
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
    public function gererSites(Request $request)
    {
        if (!$this->isGranted("ROLE_ADMIN")){
            throw new AccessDeniedException("Accès interdit !");
        }

        $sitesRepo = $this->getDoctrine()->getRepository(Sites::class);
        $sites=$sitesRepo->findAll();
        if ($sites==null){

            throw $this->createNotFoundException("Aucun site");
        }



        return $this->render('sites/gererSites.html.twig', [
            'sites' => $sites
        ]);
    }

}
