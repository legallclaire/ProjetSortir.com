<?php

namespace App\Controller;

use App\Entity\Etats;
use App\Entity\Lieux;
use App\Entity\Sites;
use App\Entity\Sorties;
use App\Entity\Villes;
use App\Form\SortieType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SortiesController extends Controller
{

    /**
     * @Route("/", name="sorties_home")
     */
    public function home()
    {

        $siteRepo = $this->getDoctrine()->getRepository(Sites::class);
        $listeSites = $siteRepo->findAll();
        $sortieRepo = $this->getDoctrine()->getRepository(Sorties::class);
        $listeSorties = $sortieRepo->findAll();
        $listeParticipants = $sortieRepo->findAllParticipants();

        return $this->render('sorties/afficherSorties.html.twig', [
            'controller_name' => 'SortiesController',
            'listeSites' => $listeSites,
            'listeSorties' => $listeSorties,
            'participants' => $listeParticipants
        ]);
    }

    /**
     * @Route("/gererSorties", name="sorties_gerer")
     */
    public function gererSorties(EntityManagerInterface $em, Request $request)
    {

        $sortie = new Sorties();
        $user = $this->getUser();
        $sortie->setOrganisateur($user);

        $site = $user->getSite();
        $sortie->setSite($site);


        $villesRepo = $this->getDoctrine()->getRepository(Villes::class);
        $listeVilles = $villesRepo->findAll();


        $sortieForm = $this->createForm(SortieType::class, $sortie);
        $sortieForm->handleRequest($request);
        if ($sortieForm->isSubmitted() && $sortieForm->isValid()) {

            //si l'utilisateur clique sur le boutton "enregistrer" :
            if ('Enregistrer' === $sortieForm->getClickedButton()->getName()) {
                $nomLieu = $request->get("select-lieux");
                $lieuxRepo = $this->getDoctrine()->getRepository(Lieux::class);
                $lieu = $lieuxRepo->findOneBy(["nom_lieu" => $nomLieu]);


                $sortie->setLieu($lieu);
                $sortie->setIsPublished(false);
                //début de gestion des états :

                $etatRepo = $this->getDoctrine()->getRepository(Etats::class);
                $etatCree = $etatRepo->find(1);
                $etatOuvert = $etatRepo->find(2);
                $etatCloture = $etatRepo->find(3);
                $etatActiviteEnCours = $etatRepo->find(4);
                $etatPasse = $etatRepo->find(5);
                $etatAnnule = $etatRepo->find(6);


                $sortie->setEtat($etatCree);

                $dateDuJour = new \DateTime('now');
                $dateDebutSortie = $sortie->getDatedebut();
                $dateCloture = $sortie->getDateclosure();
                $dateFinSortie = $sortie->getDatefin();

                if ($dateCloture > $dateDuJour) {

                    $sortie->setEtat($etatOuvert);

                } else {

                    $sortie->setEtat($etatCloture);

                }

                if ($dateDebutSortie == $dateDuJour AND $dateFinSortie >= $dateDuJour) {

                    $sortie->setEtat($etatActiviteEnCours);
                }

                if ($dateFinSortie < $dateDuJour) {

                    $sortie->setEtat($etatPasse);
                }

                //fin de gestion des états

                $em->persist($sortie);
                $em->flush();
                $this->addFlash("success", "Sortie créée !");
                return $this->redirectToRoute("sorties_home", [
                    "id" => $sortie->getId(),
                    "listeVilles" => $listeVilles]);

            }

            //si l'utilisateur clique sur le bouton "Publier la sortie":

            if ('PublierLaSortie' === $sortieForm->getClickedButton()->getName()) {

                $nomLieu = $request->get("select-lieux");
                $lieuxRepo = $this->getDoctrine()->getRepository(Lieux::class);
                $lieu = $lieuxRepo->findOneBy(["nom_lieu" => $nomLieu]);


                $sortie->setLieu($lieu);
                $sortie->setIsPublished(true);
                //début de gestion des états :

                $etatRepo = $this->getDoctrine()->getRepository(Etats::class);
                $etatCree = $etatRepo->find(1);
                $etatOuvert = $etatRepo->find(2);
                $etatCloture = $etatRepo->find(3);
                $etatActiviteEnCours = $etatRepo->find(4);
                $etatPasse = $etatRepo->find(5);
                $etatAnnule = $etatRepo->find(6);


                $sortie->setEtat($etatCree);

                $dateDuJour = new \DateTime('now');
                $dateDebutSortie = $sortie->getDatedebut();
                $dateCloture = $sortie->getDateclosure();
                $dateFinSortie = $sortie->getDatefin();

                if ($dateCloture > $dateDuJour) {

                    $sortie->setEtat($etatOuvert);

                } else {

                    $sortie->setEtat($etatCloture);

                }

                if ($dateDebutSortie == $dateDuJour AND $dateFinSortie >= $dateDuJour) {

                    $sortie->setEtat($etatActiviteEnCours);
                }

                if ($dateFinSortie < $dateDuJour) {

                    $sortie->setEtat($etatPasse);
                }

                //fin de gestion des états

                $em->persist($sortie);
                $em->flush();
                $this->addFlash("success", "Sortie publiée !");
                return $this->redirectToRoute("sorties_home", [
                    "id" => $sortie->getId(),
                    "listeVilles" => $listeVilles]);
            }


            //si l'utilisateur clique sur le boutton "supprimer" :
            if ('SupprimerLaSortie' === $sortieForm->getClickedButton()->getName()) {
                $em->remove($sortie);
                $em->flush();

                $this->addFlash("success", "Suppression effectuée");
                return $this->redirectToRoute("sorties_home");
            }
            //si l'utilisateur clique sur le boutton "annuler" :
            if ('Annuler' === $sortieForm->getClickedButton()->getName()) {


                return $this->redirectToRoute("sorties_home");
            }

        }

        return $this->render('sorties/gererSorties.html.twig', [
            'sortieForm' => $sortieForm->createView(),
            'listeVilles' => $listeVilles,
            'user' => $user,
        ]);
    }

    //Gestion de l'affichage des lieux disponibles en fonction de la ville sélectionnée (AJAX)

    /**
     * @Route("/gererSorties/villes", name="sorties_gerer_villes")
     */

    public function gererSortiesVilles(EntityManagerInterface $em, Request $request)
    {
        if ($request->request->get("id_ville")) {

            $id = $request->request->get("id_ville");

            $villeRepo = $this->getDoctrine()->getRepository(Villes::class);
            $ville = $villeRepo->find($id);

            $lieuxRepo = $this->getDoctrine()->getRepository(Lieux::class);
            $listeLieux = $lieuxRepo->findByVille($id);

            $json_data = array();
            $boucle = 0;

            foreach ($listeLieux as $lieu) {
                $tableau = array(
                    'id' => $lieu->getId(),
                    'nom' => $lieu->getNomlieu(),
                    'rue' => $lieu->getRue(),
                    'latitude' => $lieu->getLatitude(),
                    'longitude' => $lieu->getLongitude(),
                    'codePostal' => $ville->getCodePostal()

                );
                $json_data[$boucle] = $tableau;
                $boucle++;
            }
            return new JsonResponse($json_data);
        }
        return $this->render('sorties/gererSorties.html.twig');
    }

    //Gestion de l'affichage des détails du lieu en fonction du lieu sélectionné (AJAX)

    /**
     * @Route("/gererSorties/lieux", name="sorties_gerer_lieux")
     */

    public function gererSortiesLieux(EntityManagerInterface $em, Request $request)
    {
        if ($request->request->get("id_lieu")) {

            $id = $request->request->get("id_lieu");

            $lieuxRepo = $this->getDoctrine()->getRepository(Lieux::class);
            $lieu = $lieuxRepo->find($id);

            $tableau = array(
                'id' => $lieu->getId(),
                'nom' => $lieu->getNomlieu(),
                'rue' => $lieu->getRue(),
                'latitude' => $lieu->getLatitude(),
                'longitude' => $lieu->getLongitude()

            );

            $json_data[] = $tableau;

            return new JsonResponse($json_data);
        }

        return $this->render('sorties/gererSorties.html.twig');
    }

    /**
     * @Route("/rechercherSorties", name="sorties_rechercher")
     */
    public function rechercherSorties(Request $request)
    {
        $siteRepo = $this->getDoctrine()->getRepository(Sites::class);
        $listeSites = $siteRepo->findAll();
        $sortieRepo = $this->getDoctrine()->getRepository(Sorties::class);
        $listeParticipants = $sortieRepo->findAllParticipants();

        // Récupération de la liste des sortie selon le site et/ou le nom de sortie et/ou l'organisateur sélectionné(s)
        $site = $request->request->get('selectSites');
        $mot = $request->request->get('mot');


        if ($site !== "0" && !empty($mot)){
            $sortieRepo = $this->getDoctrine()->getRepository(Sorties::class);
            $sortiesRecherchees = $sortieRepo->findSortieFiltres($site, $mot);
        }elseif($site !== "0"){
            $sortieRepo = $this->getDoctrine()->getRepository(Sorties::class);
            $sortiesRecherchees = $sortieRepo->findSortieBySites($site);
        }else {
            $sortieRepo = $this->getDoctrine()->getRepository(Sorties::class);
            $sortiesRecherchees = $sortieRepo->findSortieRecherche($mot);
        }


        return $this->render('sorties/afficherSorties.html.twig', [
            'listeRecherche' => $sortiesRecherchees,
            'listeSites' => $listeSites,
            'participants' => $listeParticipants,
        ]);

    }

    /**
     * @Route("/ajouterLieu", name="sorties_ajouterLieu")
     */
    public function ajouterLieu(Request $request, EntityManagerInterface $em)
    {

        if ($request->request->get("idVille")) {

            $idVille = $request->request->get("idVille");
            $nomLieu = $request->request->get("nomLieu");
            $rueLieu = $request->request->get("rueLieu");
            $latitudeLieu = $request->request->get("latitudeLieu");
            $longitudeLieu = $request->request->get("longitudeLieu");

            $villeRepo = $this->getDoctrine()->getRepository(Villes::class);
            $ville = $villeRepo->find($idVille);

            //ajout du lieu en BDD :

            $lieu = new Lieux();

            $lieu->setNomLieu($nomLieu);
            $lieu->setVille($ville);
            $lieu->setRue($rueLieu);

            if ($latitudeLieu != null) {
                $lieu->setLatitude($latitudeLieu);
            }

            if ($longitudeLieu != null) {
                $lieu->setLongitude($longitudeLieu);
            }

            $em->persist($lieu);
            $em->flush();


            $tableau = array(
                'id' => $lieu->getId(),
                'nom' => $lieu->getNomlieu(),
                'rue' => $lieu->getRue(),
                'latitude' => $lieu->getLatitude(),
                'longitude' => $lieu->getLongitude()

            );

            $json_data[] = $tableau;

            return new JsonResponse($json_data);

        }


        return $this->render('sorties/gererSorties.html.twig');
    }


    /**
     * @Route("/modifierSortie/{id}", name="sorties_modifier", requirements={"id"="\d+"})
     */
    public function modifierSortie(Request $request, EntityManagerInterface $em, $id)
    {

        $user = $this->getUser();
        $sortie = $em->getRepository(Sorties::class)->find($id);
        $organisateur = $sortie->getOrganisateur();

        //on vérifie que l'utilisateur est bien l'organisateur de la sortie sinon il ne peut pas la modifier :

        if ($user !== $organisateur) {
            throw new AccessDeniedException("Accès interdit !");
        }


        if ($sortie == null) {

            throw $this->createNotFoundException("Participant inconnu");
        }

        //on récupère la liste des villes :

        $villesRepo = $this->getDoctrine()->getRepository(Villes::class);
        $listeVilles = $villesRepo->findAll();

        //on récupère la liste des lieux :

        $lieuRepo = $this->getDoctrine()->getRepository(Lieux::class);
        $listeLieux = $lieuRepo->findAll();

        $sortie->setNom($sortie->getNom());
        $sortie->setDatedebut($sortie->getDatedebut());
        $sortie->setDateclosure($sortie->getDateclosure());
        $sortie->setNbinscriptionsmax($sortie->getNbinscriptionsmax());

        if ($sortie->getDescriptioninfos() !== null) {
            $sortie->setDescriptioninfos($sortie->getDescriptioninfos());
        }

        if ($sortie->getDatefin() !== null) {
            $sortie->setDatefin($sortie->getDatefin());
        }
        $sortie->setLieu($sortie->getLieu());


        $sortieForm = $this->createForm(SortieType::class, $sortie);
        $sortieForm->handleRequest($request);
        if ($sortieForm->isSubmitted() && $sortieForm->isValid()) {

            //si l'utilisateur clique sur le bouton "enregistrer" :
            if ('Enregistrer' === $sortieForm->getClickedButton()->getName()) {

                $sortie->setIsPublished(false);
                $em->persist($sortie);
                $em->flush();

                $this->addFlash("success", "Modification enregistrée");
                return $this->redirectToRoute("sortie_visualiser", ['id' => $sortie->getId()]);
            }


            //si l'utilisateur clique sur le bouton "Publier la sortie":

            if ('PublierLaSortie' === $sortieForm->getClickedButton()->getName()) {

                $sortie->setIsPublished(true);
                $em->persist($sortie);
                $em->flush();

                $this->addFlash("success", "Modification enregistrée");
                return $this->redirectToRoute("sortie_visualiser", ['id' => $sortie->getId()]);
            }


            //si l'utilisateur clique sur le bouton "supprimer" :
            if ('SupprimerLaSortie' === $sortieForm->getClickedButton()->getName()) {
                $em->remove($sortie);
                $em->flush();

                $this->addFlash("success", "Suppression effectuée");
                return $this->redirectToRoute("sorties_home");
            }
            //si l'utilisateur clique sur "annuler" :
            if ('Annuler' === $sortieForm->getClickedButton()->getName()) {

                return $this->redirectToRoute("sorties_home");
            }

        }

        return $this->render('sorties/modifierSortie.html.twig', [
            "sortieForm" => $sortieForm->createView(),
            "sortie" => $sortie,
            "listeVilles" => $listeVilles,
            "listeLieux" => $listeLieux,
            "user" => $user
        ]);

    }

    /**
     * @Route("/visualiserSortie/{id}", name="sortie_visualiser", requirements={"id"="\d+"})
     */
    public function afficherSortie(Request $request, EntityManagerInterface $em, $id)
    {

        $sortie = $em->getRepository(Sorties::class)->find($id);

        $participants = [];

        $participants = $sortie->getParticipants();

        if ($sortie == null) {

            throw $this->createNotFoundException("Participant inconnu");
        }

        return $this->render('sorties/visualiserSortie.html.twig', [
            "sortie" => $sortie,
            "participants" => $participants

        ]);
    }


    //inscription à une sortie :

    /**
     * @Route("/inscription", name="sortie_inscription")
     */
    public function inscriptionSortie(Request $request, EntityManagerInterface $em)
    {

        if ($request->request->get("id")) {

            $idSortie = $request->request->get("id");

            $sortieRepo = $em->getRepository(Sorties::class);
            $sortie = $sortieRepo->find($idSortie);

            $participant = $this->getUser();
            $sortie->addParticipant($participant);

            $em->persist($sortie);
            $em->flush();

            $this->addFlash("success", "Inscription enregistrée");

            $json_data = $sortie;

            return new JsonResponse($json_data);
        }


        $siteRepo = $this->getDoctrine()->getRepository(Sites::class);
        $listeSites = $siteRepo->findAll();
        $sortieRepo = $this->getDoctrine()->getRepository(Sorties::class);
        $listeSorties = $sortieRepo->findAll();
        $listeParticipants = $sortieRepo->findAllParticipants();

        return $this->render('sorties/afficherSorties.html.twig', [
            'controller_name' => 'SortiesController',
            'listeSites' => $listeSites,
            'listeSorties' => $listeSorties,
            'participants' => $listeParticipants
        ]);

    }

//désinscription à une sortie :

    /**
     * @Route("/desinscription", name="sortie_desinscription")
     */
    public function desinscriptionSortie(Request $request, EntityManagerInterface $em)
    {

        if ($request->request->get("id")) {

            $idSortie = $request->request->get("id");

            $sortieRepo = $this->getDoctrine()->getRepository(Sorties::class);
            $sortie = $sortieRepo->find($idSortie);

            $participant = $this->getUser();

            $sortie->removeParticipant($participant);

            $em->persist($sortie);
            $em->flush();

            $this->addFlash("success", "Modification enregistrée");

            $json_data = $sortie;

            return new JsonResponse($json_data);
        }


        $siteRepo = $this->getDoctrine()->getRepository(Sites::class);
        $listeSites = $siteRepo->findAll();
        $sortieRepo = $this->getDoctrine()->getRepository(Sorties::class);
        $listeSorties = $sortieRepo->findAll();
        $listeParticipants = $sortieRepo->findAllParticipants();

        return $this->render('sorties/afficherSorties.html.twig', [
            'controller_name' => 'SortiesController',
            'listeSites' => $listeSites,
            'listeSorties' => $listeSorties,
            'participants' => $listeParticipants
        ]);

    }



    //annuler une sortie :

    /**
     * @Route("/annulation", name="sortie_annulation")
     */
    public function annulerSortie(Request $request, EntityManagerInterface $em)
    {

        if ($request->request->get("id")) {

            $idSortie = $request->request->get("id");

            $sortieRepo = $this->getDoctrine()->getRepository(Sorties::class);
            $sortie = $sortieRepo->find($idSortie);

            $organisateur = $sortie->getOrganisateur();
            $participant = $this->getUser();


            if ($participant === $organisateur) {


                $em->remove($sortie);
                $em->flush();

                $this->addFlash("success", "Modification enregistrée");
            }
            $json_data = $sortie;

            return new JsonResponse($json_data);
        }


        $siteRepo = $this->getDoctrine()->getRepository(Sites::class);
        $listeSites = $siteRepo->findAll();
        $sortieRepo = $this->getDoctrine()->getRepository(Sorties::class);
        $listeSorties = $sortieRepo->findAll();
        $listeParticipants = $sortieRepo->findAllParticipants();

        return $this->render('sorties/afficherSorties.html.twig', [
            'controller_name' => 'SortiesController',
            'listeSites' => $listeSites,
            'listeSorties' => $listeSorties,
            'participants' => $listeParticipants
        ]);

    }


//publier une sortie :

    /**
     * @Route("/publier", name="sortie_publier")
     */
    public function publierSortie(Request $request, EntityManagerInterface $em)
    {

        if ($request->request->get("id")) {

            $idSortie = $request->request->get("id");

            $sortieRepo = $this->getDoctrine()->getRepository(Sorties::class);
            $sortie = $sortieRepo->find($idSortie);

            $organisateur = $sortie->getOrganisateur();
            $participant = $this->getUser();


            if ($participant === $organisateur) {

                $sortie->setIsPublished(true);

                $em->persist($sortie);
                $em->flush();

                $this->addFlash("success", "Modification enregistrée");
            }
            $json_data = $sortie;

            return new JsonResponse($json_data);
        }


        $siteRepo = $this->getDoctrine()->getRepository(Sites::class);
        $listeSites = $siteRepo->findAll();
        $sortieRepo = $this->getDoctrine()->getRepository(Sorties::class);
        $listeSorties = $sortieRepo->findAll();
        $listeParticipants = $sortieRepo->findAllParticipants();

        return $this->render('sorties/afficherSorties.html.twig', [
            'controller_name' => 'SortiesController',
            'listeSites' => $listeSites,
            'listeSorties' => $listeSorties,
            'participants' => $listeParticipants
        ]);

    }


}