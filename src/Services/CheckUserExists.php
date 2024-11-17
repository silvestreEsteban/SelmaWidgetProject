<?php

namespace App\Services;

use App\Repository\UserRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;

class CheckUserExists
{
    private $userRepository;
    private $passwordHasher;

    public function __construct(UserRepository $userRepository, UserPasswordHasherInterface $passwordHasher)
    {
        $this->userRepository = $userRepository;
        $this->passwordHasher = $passwordHasher;
    }

    public function checkUserExists(string $email, string $password): void
    {
        $user = $this->userRepository->findOneBy(['email' => $email]);
        if (empty($user)) {
            throw new UserNotFoundException('The email/password combination is incorrect');
        }

        if (!$this->passwordHasher->isPasswordValid($user, $password)) {
            throw new BadCredentialsException('The email/password combination is incorrect');
        }
    }

    public function login($email, UserPasswordHasherInterface $passwordHasher): void
    {
        $user = $this->userRepository->findOneBy(['email' => $email]);
        $password = $user->getPassword();
        $hashedPassword = $passwordHasher->hashPassword($user, $password);
        if (!password_verify($hashedPassword, $password)) {
            throw new UserNotFoundException('The email/password combination is incorrect');
        }
    }
}
