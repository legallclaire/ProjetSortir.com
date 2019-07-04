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
    public function gererProfil(EntityManagerInterface $em, Request $request)
    {
        $participant = $this->getUser();
        if ($participant == null) {

            throw $this->createNotFoundException("Participant inconnu");
        }

        $participantForm = $this->createForm(ParticipantsType::class, $participant);

        $participantForm->handleRequest($request);
        if ($participantForm->isSubmitted() && $participantForm->isValid()) {
            if ($participantForm->get('urlPhoto')->getData() != null) {
                $file = $participantForm->get('urlPhoto')->getData();
                $fileName = $file->guessExtension();
                $file->move($this->getParameter('user_photo_directory'), $this->getUser()->getPseudo().'.'.$fileName);
                $participant->setUrlPhoto($this->getUser()->getPseudo().'.'.$fileName);
            }

            $em->persist($participant);
            $em->flush();

            $this->addFlash("success", "Votre profil a bien été modifié");
            return $this->redirectToRoute("profil_afficher", ['id' => $participant->getId()]);

        }

        return $this->render('profil/gererProfil.html.twig', [
            "participantForm" => $participantForm->createView(),
            "participant" => $participant
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
