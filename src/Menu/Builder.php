<?php

// src/Menu/Builder.php
namespace App\Menu;

use Knp\Menu\ItemInterface;
use App\Entity\PrestationType;
use Knp\Menu\FactoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

final class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    private $factory;
    private $em;

    /**
     * Add any other dependency you need...
     */
    public function __construct(FactoryInterface $factory, EntityManagerInterface $em)
    {
        $this->factory = $factory;
        $this->em = $em;
    }

    public function mainMenu(array $options): ItemInterface
    {
        $menu = $this->factory->createItem('root', [
            'childrenAttributes' => [
                'class' => 'menu principal-menu'
            ]
        ]);

        $menu->addChild('Accueil', ['route' => 'home'])
            ->setAttribute('class', 'principal-menu__item');

        // Generate items for prestations
        $prestationTypes = $this->em->getRepository(PrestationType::class)->findAll();

        foreach ($prestationTypes as $prestationType) {
            $menu->addChild($prestationType->getName(), ['route' => 'type-prestation'])
                ->setAttribute('class', 'principal-menu__item');
        }
        
        $menu->addChild('Photos', ['route' => 'photos'])
            ->setAttribute('class', 'principal-menu__item');
        $menu->addChild('Tarifs', ['route' => 'tarifs'])
            ->setAttribute('class', 'principal-menu__item');
        $menu->addChild('Contact', ['route' => 'home'])
            ->setAttribute('class', 'principal-menu__item');

        return $menu;
    }
}