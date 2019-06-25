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
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class ParticipantsController extends Controller
{
    /**
     * @Route("/login", name="participants_login")
     */
    public function login(AuthenticationUtils $autheticationUtils)
    {
        $error = $autheticationUtils->getLastAuthenticationError();
        $lastUserName = $autheticationUtils->getLastUsername();
        return $this->render('participants/index.html.twig', [
            'error' => $error,
            'lastUserName' => $lastUserName
        ]);
    }
    /**
     * @Route("/", name="participants_connection")
     */
    public function connection (EntityManagerInterface $em, Request $request, UserPasswordEncoderInterface $encoder)
    {
        $participants = new Participants();
        $participantsForm = $this->createForm(ParticipantsType::class, $participants);
        $participantsForm->handleRequest($request);
        if ($participantsForm->isSubmitted() && $participantsForm->isValid()) {
            $this->addFlash('success', 'Vous êtes connecté');
            $this->redirectToRoute('participants_login');
        }
        return $this->render('participants/index.html.twig',[
            'participantsForm'=>$participantsForm->createView()
        ]);
    }





}
