<?php

namespace App\Controller;

use App\Entity\Photo;
use App\Entity\OnadEtBeaute;
use App\Entity\PrestationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    private $manager;

    public function __construct(EntityManagerInterface $manager) {
        $this->manager = $manager;
    }

    #[Route('/', name: 'home')]
    public function home(): Response
    {

        $prestationTypes = $this->manager->getRepository(PrestationType::class)
            ->findAll();

        $principalPhoto = $this->manager->getRepository(Photo::class)
            ->findOneBy(['principalPhoto' => true]);
        
        $frontSliderPhotos = $this->manager->getRepository(Photo::class)
            ->findBy(['frontPhoto' => true]);

        $onadetbeaute = $this->manager->getRepository(OnadEtBeaute::class)
            ->findAll()[0];
        
        return $this->render('home/home.html.twig', [
            'prestationTypes' => $prestationTypes,
            'principalPhoto' => $principalPhoto,
            'onadetbeaute' => $onadetbeaute,
            'frontSliderPhotos' => $frontSliderPhotos
        ]);
    }
}
