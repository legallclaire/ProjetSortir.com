<?php

namespace App\Controller;

use App\Entity\Participants;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class ParticipantsController extends Controller
{
    /**
     * @Route("/login", name="participants_login")
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {

        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUserName = $authenticationUtils->getLastUsername();
        return $this->render('sorties/afficherSorties.html.twig', [
            'error' => $error,
            'lastUserName' => $lastUserName
        ]);
    }

    /**
     * @Route("/logout", name="participants_logout")
     */
    public function logout() {
        return $this->render('participants/login.html.twig');
    }
}
