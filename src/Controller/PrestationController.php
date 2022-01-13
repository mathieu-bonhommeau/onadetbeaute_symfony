<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PrestationController extends AbstractController
{
    #[Route('/type-prestation', name: 'type-prestation')]
    public function getPrestionTypes(): Response
    {
        return $this->render('prestation/prestation.html.twig', [
            'controller_name' => 'PrestationController',
        ]);
    }

    #[Route('/tarifs', name: 'tarifs')]
    public function getTarifs(): Response
    {
        return $this->render('prestation/tarifs.html.twig', [
            
        ]);
    }
}
