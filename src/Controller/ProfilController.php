<?php

namespace App\Controller;

use App\Entity\Participants;
use App\Form\ParticipantsType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProfilController extends Controller
{
    /**
     * @Route("/gererProfil/{id}", name="profil_gerer", requirements={"id"="\d+"})
     */
    public function gererProfil($id, EntityManagerInterface $em, Request $request)
    {
        $participant = $em->getRepository(Participants::class)->find($id);

        if ($participant == null) {

            throw $this->createNotFoundException("Participant inconnu");
        }

        $participant->setPseudo($participant->getPseudo());
        $participant->setNom($participant->getNom());
        $participant->setPrenom($participant->getPrenom());

        if ($participant->getTelephone() !== null) {
            $participant->setTelephone($participant->getTelephone());
        }


        $participant->setMail($participant->getMail());
        $participant->setSite($participant->getSite());


        $participantForm = $this->createForm(ParticipantsType::class, $participant);

        $participantForm->handleRequest($request);
        if ($participantForm->isSubmitted() && $participantForm->isValid()) {


            $em->persist($participant);
            $em->flush();

            $this->addFlash("success", "Votre profil a bien été modifié");
            return $this->redirectToRoute("profil_afficher", ['id' => $participant->getId()]);

        }

        return $this->render('profil/gererProfil.html.twig', [
            "participantForm" => $participantForm->createView(),
        ]);
    }

    /**
     * @Route("/afficherProfil/{id}", name="profil_afficher", requirements={"id"="\d+"})
     */
    public function afficherProfil($id, EntityManagerInterface $em)
    {
        $user = $em->getRepository(Participants::class)->find($id);

        if ($user == null) {
            throw $this->createNotFoundException("Utilisateur inconnu");
        }

        return $this->render('profil/afficherProfil.html.twig', [
            'user' => $user
        ]);
    }
}
