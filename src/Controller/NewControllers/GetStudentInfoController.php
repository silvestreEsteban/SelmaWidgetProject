<?php

namespace App\Controller\NewControllers;

use App\Repository\StudentInfoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class GetStudentInfoController extends AbstractController
{
    #[Route('/studentInformation/{id<\d+>}', name: 'studentInformation')]
    public function displayStudentInformation(int $id, StudentInfoRepository $studentInfoRepository): Response
    {
        $student = $studentInfoRepository->find($id);
        if (!$student) {
            throw $this->createNotFoundException('Student not found');
        }
        $learningStyle = $student->getLearningStyle();
        $neurodiversity = $student->getNeurodiversity();
        $paymentStatus = $student->getPaymentStatus();
        $gender = $student->getGender();


        return $this->render('main/studentInformation.html.twig', [
            'student' => $student,
        ]);
    }
}
