<?php

namespace App\Controller;

use App\Repository\StudentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class IndividualStudentInformationController extends AbstractController
{
    #[Route('/display/student/{id<\d+>}', name: 'display_student', methods: ['GET'])]
    public function StudentInformation(int $id, StudentRepository $studentRepository): Response
    {
        $student = $studentRepository->find($id);


        if (!$student) {
            throw $this->createNotFoundException('Student not found');
        }

        return $this->render('main/showStudent.html.twig', [
            'student' => $student,
        ]);
    }
}
