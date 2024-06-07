<?php

namespace App\Controller\API;

use App\Repository\BlogRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BlogController extends AbstractController
{

  #[Route('/api/blog', name: 'api_getBlog', methods: ['GET'])]
  public function index(BlogRepository $blogRepository, Request $request)
  {
    try {

      $page = $request->query->getInt("page", 1);
      $search = htmlspecialchars($request->query->getString("search", ''));
      $limit = 5;

      $blogs = $blogRepository->paginateBlogs(trim($search), $page, $limit);
      $maxPage = $blogRepository->countBySearch(trim($search)) / $limit;


      return $this->json([
        'success' => true,
        'data' => $blogs,
        'maxPage' => $maxPage,
        'page' => $page

      ], 200, [], [
        'groups' => ['blog.index']

      ]);
    } catch (\Throwable $th) {
      return $this->json(['success' => false, 'data' => null, 'error' => 'error : ' . $th->getMessage()], 500);
    }
  }
}
