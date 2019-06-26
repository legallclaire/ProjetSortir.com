<?php

namespace App\Controller;

use App\Entity\Participants;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class ParticipantsController extends Controller
{
    /**
     * @Route("/", name="participants_login")
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {

        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUserName = $authenticationUtils->getLastUsername();
        return $this->render('participants/index.html.twig', [
            'error' => $error,
            'lastUserName' => $lastUserName
        ]);
    }

    /**
     * @Route("/logout", name="participants_logout")
     */
    public function logout() {
        // rien
    }
}