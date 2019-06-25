<?php

namespace App\Controller;

use App\Entity\Participants;
use App\Entity\User;
use App\Form\ParticipantsType;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ParticipantsController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('participants/index.html.twig', [
            'controller_name' => 'ParticipantsController',
        ]);
    }
    /**
     * @Route("/", name="home")
     */
    public function connection (EntityManagerInterface $em, Request $request, UserPasswordEncoderInterface $encoder)
    {
        $participants = new Participants();
        $participantsForm = $this->createForm(ParticipantsType::class, $participants);
        $participantsForm->handleRequest($request);
        if ($participantsForm->isSubmitted() && $participantsForm->isValid()) {
            $hash=$encoder->encodePassword($participants, $participants->getMotDePasse());
            $participants->setMotDePasse($hash);
            $em->persist($participants);
            $em->flush();
            $this->addFlash('success', 'Votre inscription est validée');
            $this->redirectToRoute("home");
        }
        return $this->render('participants/index.html.twig',[
            'participantsForm'=>$participantsForm->createView()
        ]);
    }





}
