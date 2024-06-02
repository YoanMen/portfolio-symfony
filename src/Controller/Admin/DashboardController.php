<?php

namespace App\Controller\Admin;

use App\Entity\Blog;
use App\Entity\Link;
use App\Entity\About;
use App\Entity\LinkIcon;
use App\Entity\Project;
use App\Entity\Technology;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\Security\Core\User\UserInterface;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(): Response
    {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(AboutCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->disableDarkMode()
            ->setTitle('Admin Panel');
    }

    public function configureMenuItems(): iterable
    {
        if (!$this->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException();
        }
        yield MenuItem::linkToUrl('Retour au site', 'fas fa-home',  '/');
        yield MenuItem::section('données');
        yield MenuItem::linkToCrud('A propos', 'fas fa-info', About::class);
        yield MenuItem::linkToCrud('Projets', 'fas fa-book', Project::class);
        yield MenuItem::linkToCrud('Blog', 'fas fa-blog', Blog::class);
        yield MenuItem::section('sous-données');
        yield MenuItem::linkToCrud('Liens', 'fas fa-link', Link::class);
        yield MenuItem::linkToCrud('Technologies', 'fas fa-gear', Technology::class);
        yield MenuItem::linkToCrud('Icône des liens', 'fas fa-icons', LinkIcon::class);

        yield MenuItem::section();
        yield  MenuItem::linkToLogout('Logout', 'fa fa-sign-out');
    }

    public function configureUserMenu(UserInterface $user): UserMenu
    {
        return parent::configureUserMenu($user)->displayUserAvatar(false);
    }

    public function configureAssets(): Assets
    {
        return parent::configureAssets()->addCssFile('/assets/styles/admin.css');
    }
}
