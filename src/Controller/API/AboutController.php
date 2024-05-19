<?php

namespace App\Controller\API;

use App\Repository\AboutRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AboutController extends AbstractController
{

  #[Route("api/about", methods: ['GET'], name: 'api_getAbout')]
  public function index(AboutRepository $aboutRepository)
  {
    $about = $aboutRepository->findAll();
    return $this->json($about, 200, [], [
      'groups' => ['about.index']
    ]);
  }
}
