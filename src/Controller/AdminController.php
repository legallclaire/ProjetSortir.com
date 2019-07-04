<?php

namespace App\Controller;

use App\Entity\Participants;
use App\Form\ParticipantsType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends Controller
{
    /**
     * @Route("/admin", name="admin")
     */
    public function admin()
    {
        return $this->render('admin/admin.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("/admin/inscrireParticipant", name="admin_inscrire_participant")
     */
    public function inscrireParticipant(EntityManagerInterface $em, Request $request){
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $participant=new Participants();
        $participantForm = $this->createForm(ParticipantsType::class, $participant);

        $participantForm->handleRequest($request);
        if ($participantForm->isSubmitted() && $participantForm->isValid()) {
        $participant->setActif(true);
        $participant->setAdministrateur(false);
        $participant->setOrganisateur(false);
            $em->persist($participant);
            $em->flush();

            $this->addFlash("success", "L'inscription est validée");
            return $this->redirectToRoute("profil_afficher", ['id' => $participant->getId()]);

        }return $this->render('/admin/inscrireParticipant.html.twig', [
            'formParticipant'=> $participantForm->createView()
        ]);
    }




}
