<?php

namespace App\Controller;

use App\Entity\OnadEtBeaute;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FacebookPostsController extends AbstractController
{
    #[Route('/getPosts', name: 'facebook_posts')]
    public function getToken(Request $request, EntityManagerInterface $manager): Response
    {
        if ($request->isXmlHttpRequest()) {
            $onadetbeaute = $manager->getRepository(OnadEtBeaute::class)->findAll()[0];

            return $this->json([$onadetbeaute], 200);
        }
        return $this->json('oups !', 500);
    }
}
