<?php

namespace App\Controller;

use App\Entity\Photo;
use App\API\FacebookAPI;
use App\Entity\OnadEtBeaute;
use App\Entity\PrestationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Contracts\Cache\ItemInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    private EntityManagerInterface $manager;

    private FacebookAPI $facebookApi;

    public function __construct(EntityManagerInterface $manager, FacebookAPI $facebookApi)
    {
        $this->manager = $manager;
        $this->facebookApi = $facebookApi;
    }

    #[Route('/', name: 'home')]
    public function home(Request $request): Response
    {
        
        $prestationTypes = $this->manager->getRepository(PrestationType::class)
            ->findAll();

        $principalPhoto = $this->manager->getRepository(Photo::class)
            ->findOneBy(['principalPhoto' => true]);
        
        $frontSliderPhotos = $this->manager->getRepository(Photo::class)
            ->findBy(['frontPhoto' => true]);

        $isMyWorksPhotos = $this->manager->getRepository(Photo::class)
            ->findBy(['isMyWorksPhoto' => true]);

        $onadetbeaute = $this->manager->getRepository(OnadEtBeaute::class)
            ->findAll()[0];

        //The code send by facebook api in the request uri (GET parameter)
        if ($request->get('code')) {
            $this->facebookApi->getAccessToken($request->get('code'));
        }

        return $this->render('home/home.html.twig', [
            'prestationTypes' => $prestationTypes,
            'principalPhoto' => $principalPhoto,
            'onadetbeaute' => $onadetbeaute,
            'frontSliderPhotos' => $frontSliderPhotos,
            'isMyWorksPhotos' => $isMyWorksPhotos
        ]);
    }
}
