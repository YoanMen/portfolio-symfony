<?php

namespace App\Repository;

use App\Entity\Blog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Blog>
 */
class BlogRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Blog::class);
    }


    public function paginateBlogs(string $search, int $page, int $limit): Paginator
    {
        $searchTerm = '%' . $search . '%';

        return new Paginator($this->createQueryBuilder('r')
            ->where('r.name LIKE :search OR r.detail LIKE :search')
            ->setFirstResult(($page - 1) * $limit)
            ->setParameter('search', $searchTerm)
            ->setMaxResults($limit));
    }
}
