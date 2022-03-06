<?php

namespace App\Controller;

use App\Entity\Photo;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class PhotoController extends AbstractController
{
    #[Route('/photos/{filter}', name: 'photo-filter')]
    #[Route('/photos', name: 'photos')]
    public function getPhotos(EntityManagerInterface $manager, Request $request, $filter = null): Response
    {
        $photos = $manager->getRepository(Photo::class)->findAll();

        $tags = [];

        foreach ($photos as $photo) {
            foreach ($photo->getTags() as $tag) {
                $tags[] = $tag;
            }
        }

        if ($request->isXmlHttpRequest() && !$filter) {
            return $this->json($photos, 200, [], [
                'groups' => 'list-photos'
            ]);
        }

        if ($request->isXmlHttpRequest() && $filter) {
            
            $photoFiltered = array_map(
                function ($photo) use ($filter) {
                    return in_array($filter, $photo->getTags()) ? $photo : null;
                },
                $photos
            );
            
            return $this->json($photoFiltered, 200, [], [
                'groups' => 'list-photos'
            ]);
        }

        return $this->render('photos/photos.html.twig', [
            'photos' => $photos,
            'tags' => array_unique($tags)
        ]);
    }
}
