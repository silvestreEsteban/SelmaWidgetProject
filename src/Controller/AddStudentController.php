<?php

namespace App\Controller;

use App\Entity\Student;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/student/add', name: 'student_add')]
class AddStudentController extends AbstractController
{
    /**
     * @throws \DateMalformedStringException
     */
    #[Route('', name: 'student_add_form', methods: ['GET'])]
    public function addForm(): Response
    {
        return $this->render('main/addNewStudent.html.twig');
    }

    #[Route('', name: '', methods: ['POST'])]
    public function addNewStudent(Request $request, EntityManagerInterface $entityManager): Response
    {
        $student = new Student();
        $student->setName($request->request->get('name'));
        $student->setEmail($request->request->get('email'));
        $student->setDateOfBirth(new \DateTime($request->request->get('date_of_birth')));
        $student->setPhoneNumber($request->request->get('phone_number'));
        $student->setLearningStyle($request->request->get('learning_style'));
        $student->setNeurodiversity($request->request->get('neurodiversity'));
        $student->setCreatedAt(new \DateTimeImmutable());

        $entityManager->persist($student);
        $entityManager->flush();

        return $this->redirectToRoute('app_display');
    }
}
