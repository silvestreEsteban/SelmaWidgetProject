<?php

namespace App\Controller\DisplayDataControllers;

use App\Repository\StudentInfoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

class DisplayIndividualStudentController extends AbstractController
{
    #[Route('/display/display-student/{id<\d+>}', name: 'display_student')]
    public function displayStudent(int $id, StudentInfoRepository $studentInfoRepository)
    {
        $student = $studentInfoRepository->find($id);
        $student->getNeurodiversity();
        $student->getGender();
        $student->getLearningStyle();

        if (!$student) {
            throw $this->createNotFoundException('Student not found');
        }

        return $this->render('display-students/displayIndividualStudent.html.twig', [
            'student' => $student,
        ]);
    }
}
