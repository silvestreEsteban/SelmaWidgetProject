<?php

// src/Controller/Admin/UserController.php

namespace App\Controller\Admin;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class UserController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/admin/users', name: 'admin_users_list')]
    public function listUsers(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_REGISTRAR');

        $users = $this->entityManager->getRepository(User::class)->findAll();

        // Define available roles - you might want to store these elsewhere
        $availableRoles = [
            'ROLE_REGISTRAR',
            'ROLE_ADMIN',
            'ROLE_TEACHER',
            'ROLE_TUTOR',
        ];

        return $this->render('admin/users.html.twig', [
            'users' => $users,
            'available_roles' => $availableRoles,
        ]);
    }

    #[Route('/admin/users/{id}/update-role', name: 'admin_update_user_role', methods: ['POST'])]
    public function updateUserRole(Request $request, User $user): Response
    {
        $this->denyAccessUnlessGranted('ROLE_REGISTRAR');

        // Prevent admins from modifying their own roles
        if ($user === $this->getUser()) {
            throw new AccessDeniedException('You cannot modify your own roles.');
        }

        // Get the selected role from the form
        $selectedRole = $request->request->get('role');

        // Initialize roles array with ROLE_USER
        $roles = ['ROLE_USER'];

        // Add the selected role if it's not empty and not ROLE_USER
        if (!empty($selectedRole) && 'ROLE_USER' !== $selectedRole) {
            $roles[] = $selectedRole;
        }

        // Update user roles
        $user->setRoles($roles);
        $this->entityManager->flush();

        $this->addFlash('success', 'User role updated successfully.');

        return $this->redirectToRoute('admin_users_list');
    }
}
