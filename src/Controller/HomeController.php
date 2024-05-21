<?php

namespace App\Controller;

use App\DTO\ContactDTO;
use App\Form\ContactType;
use App\Repository\AboutRepository;
use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(AboutRepository $aboutRepository, ProjectRepository $projectRepository): Response
    {

        $about = $aboutRepository->findAll();
        $projects = $projectRepository->findAll();

        $contactForm = $this->createForm(ContactType::class, new ContactDTO());

        return $this->render('home/index.html.twig', [
            'about' => $about,
            'projects' => $projects,
            'contactForm' => $contactForm
        ]);
    }
}
