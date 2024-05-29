<?php

namespace App\Controller\API;

use App\Repository\BlogRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class BlogController extends AbstractController
{

  #[Route('/api/blog', name: 'api_getBlog', methods: ['GET'])]
  public function index(BlogRepository $blogRepository, Request $request)
  {

    $page = $request->query->getInt("page", 1);
    $search = $request->query->getString("search", '');

    $limit = 5;

    $blogs = $blogRepository->paginateBlogs(trim($search), $page, $limit);
    $maxPage = ceil($blogRepository->count() / $limit);
    return $this->json([
      'data' => $blogs,
      'maxPage' => $maxPage,
      'page' => $page

    ], 200, [], [
      'groups' => ['blog.index']

    ]);
  }
}
