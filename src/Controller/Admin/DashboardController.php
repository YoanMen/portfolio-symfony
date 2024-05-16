<?php

namespace App\Controller\Admin;

use App\Entity\About;
use App\Entity\Blog;
use App\Entity\Link;
use App\Entity\Project;
use App\Entity\Technology;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {


        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(AboutCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Portfolio Symfony');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToCrud('A propos', 'fas fa-info', About::class);
        yield MenuItem::linkToCrud('Projets', 'fas fa-book', Project::class);
        yield MenuItem::linkToCrud('Blog', 'fas fa-blog', Blog::class);
        yield MenuItem::linkToCrud('Liens', 'fas fa-link', Link::class);
        yield MenuItem::linkToCrud('Technologies', 'fas fa-gear', Technology::class);
    }
}
