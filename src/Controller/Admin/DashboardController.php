<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Photo;
use App\Entity\Prestation;
use App\Entity\PrestationType;
use App\Controller\Admin\PhotoCrudController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $routeBuilder = $this->get(AdminUrlGenerator::class);
        $url = $routeBuilder->setController(PhotoCrudController::class)->generateUrl();

        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('ONad&Beaute');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToRoute('Retour au site', 'fas fa-home', 'homepage');
        yield MenuItem::linkToCrud('Photo', 'fas fa-images', Photo::class);
        yield MenuItem::linkToCrud(
            'Catégorie de prestation', 
            'fas fa-air-freshener', 
            PrestationType::class
        );
        yield MenuItem::linkToCrud(
            'Prestation', 
            'fas fa-hand-sparkles', 
            Prestation::class
        );
        yield MenuItem::linkToCrud('Utilisateur', 'fas fa-user', User::class);
    }
}