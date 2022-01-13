<?php

namespace App\Controller;

use App\Repository\PrestationTypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function home(PrestationTypeRepository $prestationTypeRepository): Response
    {
        $prestationTypes = $prestationTypeRepository->findAll();

        return $this->render('home/home.html.twig', [
            'prestationTypes' => $prestationTypes,
        ]);
    }
}
