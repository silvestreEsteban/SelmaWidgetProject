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
        $learningStyles = [];

        foreach ($students as $student) {
            if ($student) {
                $styles = $student->getLearningStyle();
                if ($styles) {
                    $stylesArray = explode(', ', $styles);
                    foreach ($stylesArray as $style) {
                        $style = trim($style);
                        if (!array_key_exists($style, $learningStyles)) {
                            $learningStyles[$style] = 0;
                        }
                        ++$learningStyles[$style];
                    }
                }
            }
        }


        $neurodiversities = [];

        foreach ($students as $student) {
            $neurodiversity = $student->getNeurodiversity();
            if ($neurodiversity) {
                if (!array_key_exists($neurodiversity, $neurodiversities)) {
                    $neurodiversities[$neurodiversity] = 0;
                }
                ++$neurodiversities[$neurodiversity];
            } else {
                if (!array_key_exists('None', $neurodiversities)) {
                    $neurodiversities['None'] = 0;
                }
                ++$neurodiversities['None'];
            }
        }

        return $this->render('chart.html.twig', [
            'learningStyles' => $learningStyles,
            'neurodiversities' => $neurodiversities,
        ]);
    }
}
