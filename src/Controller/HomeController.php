<?php

namespace App\Controller;

use App\Repository\PhotoRepository;
use App\Repository\PrestationTypeRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function home(PrestationTypeRepository $prestationTypeRepository, PhotoRepository $photoRepository): Response
    {
        $prestationTypes = $prestationTypeRepository->findAll();
        $frontPhoto = $photoRepository->findOneBy(['frontPhoto' => true]);
        
        return $this->render('home/home.html.twig', [
            'prestationTypes' => $prestationTypes,
            'frontPhoto' => $frontPhoto
        ]);
    }
}
