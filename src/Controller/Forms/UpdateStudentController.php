<?php

namespace App\Controller\Forms;

use App\Entity\StudentInfo;
use App\Controller\Forms\StudentType;
use App\Repository\StudentInfoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UpdateStudentController extends AbstractController
{
    #[Route('/update/student/{id<\d+>}', name: 'update_student')]
    public function new(int $id, Request $request, EntityManagerInterface $entityManager, StudentInfoRepository $studentInfoRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_TEACHER');

        $student = $entityManager->getRepository(StudentInfo::class)->find($id);
        if (!$student) {
            throw $this->createNotFoundException('Student not found');
        }

        $form = $this->createForm(StudentType::class, $student);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('displayAllStudents');
        }

        return $this->render('forms/update-student.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
