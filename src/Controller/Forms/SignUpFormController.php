<?php

namespace App\Controller\Forms;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SignUpFormController extends AbstractController
{
    #[Route('/sign-up', name: 'sign-up')]
    public function signUpForm(): Response
    {
        return $this->render('auth/signup.html.twig');
    }
}