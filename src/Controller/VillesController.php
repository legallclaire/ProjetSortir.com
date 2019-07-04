<?php

namespace App\Controller;

use App\Entity\Villes;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\JsonResponse;
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



    /**
     * @Route("/gererVilles/ajoutVille", name="sites_ajouterVille")
     */
    public function ajouterVille(EntityManagerInterface $em, Request $request)
    {

        if (!$this->isGranted("ROLE_ADMIN")) {
            throw new AccessDeniedException("Accès interdit !");
        }

        if($request->request->get("nomVille")){

            $nomVille=$request->request->get("nomVille");
            $codePostal=$request->request->get("codePostal");

            $ville = new Villes();
            $ville->setNomVille($nomVille);
            $ville->setCodePostal($codePostal);

            $em->persist($ville);
            $em->flush();


            $json_data = $nomVille;

            return new JsonResponse($json_data);

        }

        $villesRepo = $this->getDoctrine()->getRepository(Villes::class);
        $villes=$villesRepo->findAll();
        return $this->render('villes/gererVilles.html.twig', [
            'villes' => $villes
        ]);

    }
}
