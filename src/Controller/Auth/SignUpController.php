<?php

namespace App\Controller\Auth;

use App\Controller\Forms\SignUpType;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SignUpController extends AbstractController
{

    #[Route('/signup', name: 'sign-up')]
    public function signUpForm(Request $request, EntityManagerInterface $entityManager): Response
    {
        $newUser = new User();

        $form = $this->createForm(SignUpType::class, $newUser);



        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($newUser);
            $entityManager->flush();

            return $this->redirectToRoute('app_chart');
        }



        return $this->render('auth/signup.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
