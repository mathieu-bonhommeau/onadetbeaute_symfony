<?php

namespace App\Controller;

use App\Entity\Prestation;
use App\Entity\PrestationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PrestationController extends AbstractController
{
    private $manager;

    public function __construct(EntityManagerInterface $manager) {
        $this->manager = $manager;
    }

    #[Route('/prestation/{slug}', name: 'type-prestation')]
    public function getPrestationTypes(PrestationType $prestationType): Response
    {
        $prestations = $this->manager->getRepository(Prestation::class)->findBy(['prestationType' => $prestationType]);

        return $this->render('prestations/prestation.html.twig', [
            'prestationType' => $prestationType,
            'prestations' => $prestations 
        ]);
    }

    #[Route('/tarifs', name: 'tarifs')]
    public function getTarifs(): Response
    {
        $prestations = $this->manager->getRepository(Prestation::class)->findOrderByType();

        return $this->render('prestations/tarifs.html.twig', [
            'prestations' => $prestations
        ]);
    }

}
