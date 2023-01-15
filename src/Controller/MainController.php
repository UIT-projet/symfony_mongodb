<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{


    #[Route('/home/{slug?}', name: 'app_main'/*, requirements: ["slug"=>".+"]*/)]
    public function index(): Response
    {
        return $this->render('main/index.html.twig', [

        ]);
    }

    #[Route('/', name: 'app_index')]
    public function main(): Response
    {
        return $this->redirectToRoute('app_main');
    }
}
