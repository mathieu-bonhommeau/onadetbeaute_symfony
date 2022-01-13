<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PhotoController extends AbstractController
{
    #[Route('/photos', name: 'photos')]
    public function getPhotos(): Response
    {
        return $this->render('photos/photos.html.twig', [
            'controller_name' => 'PhotoController',
        ]);
    }
}
