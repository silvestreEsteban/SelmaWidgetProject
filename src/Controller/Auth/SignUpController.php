<?php

namespace App\Controller\Auth;

use App\Controller\Forms\SignUpType;
use App\Entity\User;
use App\Security\FormLoginAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;

class SignUpController extends AbstractController
{
    #[Route('/signup', name: 'sign-up')]
    public function signUpForm(
        Request $request,
        EntityManagerInterface $entityManager,
        UserPasswordHasherInterface $passwordHasher,
        UserAuthenticatorInterface $userAuthenticator,
        FormLoginAuthenticator $formLoginAuthenticator,
    ): Response {
        $newUser = new User();
        $newUser->setRoles(['ROLE_USER']);
        $form = $this->createForm(SignUpType::class, $newUser);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $plaintextPassword = $newUser->getPassword();
            $hashedPassword = $passwordHasher->hashPassword($newUser, $plaintextPassword);
            $newUser->setPassword($hashedPassword);
            $entityManager->persist($newUser);
            $entityManager->flush();

            return $userAuthenticator->authenticateUser(
                $newUser,
                $formLoginAuthenticator,
                $request
            );
        }

        return $this->render('auth/signup.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
