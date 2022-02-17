<?php

namespace App\Controller;

use App\Entity\Photo;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PhotoController extends AbstractController
{
    #[Route('/photos', name: 'photos')]
    public function getPhotos(EntityManagerInterface $manager): Response
    {
        $photos = $manager->getRepository(Photo::class)->findAll();

        return $this->render('photos/photos.html.twig', [
            'photos' => $photos,
        ]);
    }
}
