<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class ParticipantsController extends Controller
{
    /**
     * @Route("/", name="participants_login")
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

}
