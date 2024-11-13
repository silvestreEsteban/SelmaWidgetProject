<?php

namespace App\Controller;

use App\Repository\StudentInfoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function indexFn(): Response
    {
        return $this->render('main/index.html.twig');
    }

}
