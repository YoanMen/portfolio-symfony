<?php

namespace App\Controller\Admin;

use App\Entity\Blog;
use App\Entity\Link;
use App\Entity\About;
use App\Entity\Project;
use App\Entity\LinkIcon;
use App\Document\Visitors;
use App\Entity\Technology;
use App\Repository\AuthAttemptRepository;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

use function PHPSTORM_META\map;

class DashboardController extends AbstractDashboardController
{

    public function __construct(private DocumentManager $documentManager, private ChartBuilderInterface $chartBuilder, private AuthAttemptRepository $authAttemptRepository)
    {
    }

    #[Route('/admin', name: 'app_admin')]
    public function index(): Response
    {

        $attempt = $this->authAttemptRepository->findAll();
        return $this->render('admin/dashboard.html.twig', [
            "attempt" => $attempt[0] ?? null,
            'chart' => $this->setChart(),
        ]);

        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(AboutCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->disableDarkMode()
            ->setFaviconPath('images/favicon.ico')
            ->setTitle('Admin Panel');
    }

    public function configureMenuItems(): iterable
    {
        if (!$this->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException();
        }
        yield MenuItem::linkToUrl('Back to Website', 'fas fa-home',  '/');


        yield MenuItem::section();
        yield MenuItem::LinkToDashboard("Dashboard", "fas fa-chart-line");
        yield MenuItem::linkToCrud('About', 'fas fa-info', About::class);
        yield MenuItem::linkToCrud('Project', 'fas fa-book', Project::class);
        yield MenuItem::linkToCrud('Blog', 'fas fa-blog', Blog::class);
        yield MenuItem::section();
        yield MenuItem::linkToCrud('Link', 'fas fa-link', Link::class);
        yield MenuItem::linkToCrud('Technology', 'fas fa-gear', Technology::class);
        yield MenuItem::linkToCrud('Link icon', 'fas fa-icons', LinkIcon::class);

        yield MenuItem::section();
        yield  MenuItem::linkToLogout('Logout', 'fa fa-sign-out');
    }

    public function configureUserMenu(UserInterface $user): UserMenu
    {
        return parent::configureUserMenu($user)
            ->addMenuItems([
                MenuItem::linkToUrl('Back to Website', 'fas fa-home',  '/'),
            ])
            ->displayUserAvatar(false);
    }

    public function configureAssets(): Assets
    {
        return parent::configureAssets()
            ->addAssetMapperEntry('app')
            ->addCssFile('/styles/admin.css');
    }



    public function setChart()
    {

        $repository =  $this->documentManager->getRepository(Visitors::class);

        $visitors = $repository->createQueryBuilder()
            ->sort(['date' => 'desc'])
            ->limit(10)
            ->getQuery()->execute()->toArray();

        $visitors = array_reverse($visitors);

        $chart = $this->chartBuilder->createChart(Chart::TYPE_LINE);

        $formattedDates = array_map(function ($visitor) {
            return $visitor->getDate();
        }, $visitors);

        $clicks = array_map(function ($visitor) {
            return $visitor->getNumber();
        }, $visitors);


        $chart->setData([
            'labels' => $formattedDates,
            'datasets' => [
                [
                    'label' => 'number of visitors',
                    'backgroundColor' => '#2276f5',
                    'borderColor' => '#30363d',
                    'data' => $clicks,
                ],
            ],
        ]);

        $chart->setOptions([
            'scales' => [
                'y' => [
                    'suggestedMin' => 0,
                    'suggestedMax' => (!empty($clicks)) ?  max($clicks) + 10 : 50,
                ],
            ],
        ]);

        return $chart;
    }
}
