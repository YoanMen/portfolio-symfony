<?php

namespace App\Controller;

use App\Repository\AboutRepository;
use App\Repository\BlogRepository;
use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(AboutRepository $aboutRepository, ProjectRepository $projectRepository, BlogRepository $blogRepository): Response
    {

        $about = $aboutRepository->findAll();
        $projects = $projectRepository->findAll();
        $blogs = $blogRepository->findAll();

        return $this->render('home/index.html.twig', [
            'about' => $about,
            'projects' => $projects,
            'blogs' => null

        ]);
    }
}
