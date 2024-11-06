<?php

namespace App\Controller;

use App\Repository\StudentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FetchNeurodiversityDataController extends AbstractController
{
    public function neurodiversityData(StudentRepository $studentRepository)
    {
        $students = $studentRepository->findAll();
        $neurodiversities = [
            'Autism' => 0,
            'Dyslexia' => 0,
            'Dyspraxia' => 0,
            'Dyscalculia' => 0,
        ];

        foreach ($students as $student) {
            $neurodiversity = $student->getNeurodiversity();
            if (array_key_exists($neurodiversity, $neurodiversities)) {
                ++$neurodiversities[$neurodiversity];
            }
        }

        return $this->render('_neurodiversityChart.html.twig', [
            'neurodiversities' => $neurodiversities,
        ]);
    }
}
