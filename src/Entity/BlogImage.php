<?php

namespace App\Entity;

use App\Repository\BlogImageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BlogImageRepository::class)]
class BlogImage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'blogImages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Image $imageID = null;

    #[ORM\ManyToOne(inversedBy: 'blogImages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Blog $blogID = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImageID(): ?Image
    {
        return $this->imageID;
    }

    public function setImageID(?Image $imageID): static
    {
        $this->imageID = $imageID;

        return $this;
    }

    public function getBlogID(): ?Blog
    {
        return $this->blogID;
    }

    public function setBlogID(?Blog $blogID): static
    {
        $this->blogID = $blogID;

        return $this;
    }
}
