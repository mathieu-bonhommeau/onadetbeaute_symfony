<?php

// src/Menu/Builder.php
namespace App\Menu;

use Knp\Menu\ItemInterface;
use App\Entity\PrestationType;
use Knp\Menu\FactoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

/**
 * Class for create menu with the knp bundle
 * Each menu/method have a tag in services.yaml - Theiy are call in twig by this tag => "{{ knp_menu_render('main') }}"
 */
final class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    private $factory; 
    private $em;
    private $requestStack;

    public function __construct(FactoryInterface $factory, EntityManagerInterface $em, RequestStack $requestStack)
    {
        $this->factory = $factory;
        $this->em = $em;
        $this->requestStack = $requestStack;
    }

    /**
     * Build the main menu
     *
     * @param array $options
     * @return ItemInterface
     */
    public function mainMenu(array $options): ItemInterface
    {
        $requestUri = $this->requestStack->getCurrentRequest()->getRequestUri();

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
            $menu->addChild($prestationType->getName(), [
                'route' => 'type-prestation',
                'routeParameters' => ['slug' => $prestationType->getSlug()]
            ])
                ->setAttribute('class', 'principal-menu__item');
        }
        
        $menu->addChild('Photos', ['route' => 'photos'])
            ->setAttribute('class', 'principal-menu__item');
        $menu->addChild('Tarifs', ['route' => 'tarifs'])
            ->setAttribute('class', 'principal-menu__item');
        $menu->addChild('Contact', ['uri' => $requestUri . '#contact'])
            ->setAttribute('class', 'principal-menu__item');

        return $menu;
    }

    /**
     * Build the footer menu
     *
     * @param array $options
     * @return ItemInterface
     */
    public function footerMenu(array $options): ItemInterface
    {
        $menu = $this->factory->createItem('root', [
            'childrenAttributes' => [
                'class' => 'menu footer-menu'
            ]
        ]);

        $menu->addChild('Accueil', ['route' => 'home'])
            ->setAttribute('class', 'footer-menu__item orange orange--hover');

        // Generate items for prestations
        $prestationTypes = $this->em->getRepository(PrestationType::class)->findAll();

        foreach ($prestationTypes as $prestationType) {
            $menu->addChild($prestationType->getName(), [
                'route' => 'type-prestation',
                'routeParameters' => ['slug' => $prestationType->getSlug()]
            ])
                ->setAttribute('class', 'footer-menu__item orange orange--hover');
        }
        
        $menu->addChild('Photos', ['route' => 'photos'])
            ->setAttribute('class', 'footer-menu__item orange orange--hover');
        $menu->addChild('Tarifs', ['route' => 'tarifs'])
            ->setAttribute('class', 'footer-menu__item orange orange--hover');

        return $menu;
    }
}