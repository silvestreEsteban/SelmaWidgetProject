<?php

namespace App\Controller\NewControllers;

use App\Repository\StudentInfoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DisplayAllStudentsController extends AbstractController
{
    #[Route('/display/displayAll', name: 'displayAllStudents')]
    public function displayAllStudents(StudentInfoRepository $studentInfoRepository): Response
    {
        $students = $studentInfoRepository->findAll();

        return $this->render('display-students/displayAllStudents.html.twig', [
            'students' => $students,
        ]);
    }
}
