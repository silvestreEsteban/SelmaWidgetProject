<?php

namespace App\Controller\Forms;

use App\Entity\StudentInfo;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AddNewStudentFormController extends AbstractController
{
    #[Route('/new-student', name: 'new_student')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_TEACHER');

        $student = new StudentInfo();

        $form = $this->createForm(StudentType::class, $student);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($student);
            $entityManager->flush();

            return $this->redirectToRoute('displayAllStudents');
        }

        return $this->render('forms/new-student.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
