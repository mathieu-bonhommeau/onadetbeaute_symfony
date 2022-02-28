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
        $prestationsType = $this->manager->getRepository(PrestationType::class)->findAll();
        $prestationsSorted = [];

        foreach ($prestationsType as $type) {
            $prestations = $this->manager->getRepository(Prestation::class)->findBy(['prestationType' => $type]);
            $prestationsSorted[$type->getName()] = usort($prestations, function ($a, $b) {
                ($a->getPrice() - $b->getPrice());
            });
        }
        dump($prestationsSorted);

        /*$sort = usort($prestations, function ($a, $b) {
            return $a->getPrestationType() < $b->getPrestationType() ? -1 : 1;
        });*/

        return $this->render('prestations/tarifs.html.twig', [
            'prestations' => $prestationsSorted
        ]);
    }

}
