<?php

namespace App\Controller;

use App\Repository\StudentInfoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChartController extends AbstractController
{
    #[Route('/chart', name: 'app_chart')]
    public function chart(StudentInfoRepository $studentInfoRepository): Response
    {
        $students = $studentInfoRepository->findAll();
        $neurodiversities = [];
        $learningStyles = [];
        $paymentStatus = [];

        foreach ($students as $student) {
            $status = $student->getPaymentStatus();
            if ($status) {
                $payStatus = $status->getPaymentStatus();
                if (!array_key_exists($payStatus, $paymentStatus)) {
                    $paymentStatus[$payStatus] = 0;
                } ++$paymentStatus[$payStatus];
            }
        }

        foreach ($students as $student) {
            $learningStyle = $student->getLearningStyle();
            if ($learningStyle) {
                $style = (string) $learningStyle;
                if (!array_key_exists($style, $learningStyles)) {
                    $learningStyles[$style] = 0;
                } ++$learningStyles[$style];
            } else {
                if (!array_key_exists('Nature', $learningStyles)) {
                    $learningStyles['Nature'] = 0;
                }
                ++$learningStyles['Nature'];
            }

            $neurodiversity = $student->getNeurodiversity();
            if ($neurodiversity) {
                $diversity = (string) $neurodiversity;
                if (!array_key_exists($diversity, $neurodiversities)) {
                    $neurodiversities[$diversity] = 0;
                }
                ++$neurodiversities[$diversity];
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
            'students' => $students,
            'paymentStatus' => $paymentStatus,
        ]);
    }
}
