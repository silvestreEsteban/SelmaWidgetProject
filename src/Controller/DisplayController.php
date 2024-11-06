<?php

namespace App\Controller;

use App\Repository\StudentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

class DisplayController extends AbstractController
{
    #[Route('/display', name: 'app_display')]
    public function display(StudentRepository $studentRepository)
    {
        $students = $studentRepository->findAll();

        return $this->render('main/student-info.html.twig', [
            'students' => $students,
        ]);
    }
}