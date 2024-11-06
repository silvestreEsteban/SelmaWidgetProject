<?php

namespace App\Controller;

use App\Repository\StudentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChartController extends AbstractController
{
    #[Route('/chart', name: 'app_chart')]
    public function chart(StudentRepository $studentRepository): Response
    {
        $students = $studentRepository->findAll();
        $learningStyles = [
            'Visual' => 0,
            'Logical' => 0,
            'Solitary' => 0,
            'Read/Write' => 0,
            'Auditory' => 0,
            'Kinesthetic' => 0,
            'Nature' => 0,
            'Social' => 0,
        ];

        foreach ($students as $student) {
            $styles = explode(', ', $student->getLearningStyle());
            foreach ($styles as $style) {
                $style = trim($style);
                if (isset($learningStyles[$style])) {
                    ++$learningStyles[$style];
                }
            }
        }

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

        return $this->render('chart.html.twig', [
            'learningStyles' => $learningStyles,
            'neurodiversities' => $neurodiversities,
        ]);
    }
}
