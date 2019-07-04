<?php

namespace App\Controller;

use App\Entity\Sites;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
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
    public function gererSites(Request $request, EntityManagerInterface $em)
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
            'sites' => $sites]);


    }

    /**
     * @Route("/gererSites/recherche", name="sites_rechercher")
     */
    public function rechercherSite(Request $request, EntityManagerInterface $em)
    {

        $searchTerm = $request->query->get('search');

        $search = $em->getRepository('App:Sites')->findBy(['nom_site' => $searchTerm]);

//        $content = $this->renderView('sites/gererSites.html.twig', [
//            'results' => $search
//        ]);


        $response= new JsonResponse();
        $response->setData(array('resultats'=>$search));
        return $response;

    }

    /**
     * @Route("/gererSites/ajoutSite", name="sites_ajouterSite")
     */
    public function ajouterSite(EntityManagerInterface $em, Request $request)
    {

        if (!$this->isGranted("ROLE_ADMIN")) {
            throw new AccessDeniedException("Accès interdit !");
        }

        if($request->request->get("site")){

            $nomSite=$request->request->get("site");

            $site = new Sites();
            $site->setNomSite($nomSite);

            $em->persist($site);
            $em->flush();


            $json_data = $nomSite;

            return new JsonResponse($json_data);

        }

        $sitesRepo = $this->getDoctrine()->getRepository(Sites::class);
        $sites=$sitesRepo->findAll();
        if ($sites==null){
            throw $this->createNotFoundException("Aucun site");
        }
        return $this->render('sites/gererSites.html.twig', [
            'sites' => $sites]);


    }

    /**
     * @Route("/gererSites/modifierSite", name="sites_modifierSite")
     */
    public function modifierSite(EntityManagerInterface $em, Request $request)
    {

        if (!$this->isGranted("ROLE_ADMIN")) {
            throw new AccessDeniedException("Accès interdit !");
        }

        if($request->request->get("valeurSite")){

            $nomSite=$request->request->get("valeurSite");
            $id=$request->request->get("idSite");

            $sitesRepo = $this->getDoctrine()->getRepository(Sites::class);
            $site=$sitesRepo->find($id);


            $em->persist($site);
            $em->flush();


            $json_data = $nomSite;

            return new JsonResponse($json_data);

        }

        $sitesRepo = $this->getDoctrine()->getRepository(Sites::class);
        $sites=$sitesRepo->findAll();
        if ($sites==null){
            throw $this->createNotFoundException("Aucun site");
        }
        return $this->render('sites/gererSites.html.twig', [
            'sites' => $sites]);


    }


}
