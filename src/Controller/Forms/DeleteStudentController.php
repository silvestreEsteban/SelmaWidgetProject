<?php

namespace App\Controller\Forms;

use App\Entity\StudentInfo;
use App\Repository\StudentInfoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DeleteStudentController extends AbstractController
{
    #[Route('/display/student/{id}/delete', name: 'app_delete_student')]
    public function deleteStudent(StudentInfo $student, EntityManagerInterface $entityManager, StudentInfoRepository $studentRepository, Request $request): Response
    {

        $entityManager->remove($student);
        $entityManager->flush();

        return $this->redirectToRoute('displayAllStudents');
    }
}
