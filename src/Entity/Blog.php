<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\BlogRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: BlogRepository::class)]
class Blog
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups('blog.index')]
    private ?int $id = null;


    #[ORM\Column(length: 120)]
    #[Groups('blog.index')]

    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups('blog.index')]
    private ?string $detail = null;

    #[ORM\Column]
    #[Groups('blog.index')]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    /**
     * @var Collection<int, BlogImage>
     */

    #[ORM\OneToMany(targetEntity: BlogImage::class, mappedBy: 'blog', cascade: ['persist'], orphanRemoval: true)]
    #[Groups('blog.index')]
    private Collection $blogImages;



    public function __construct()
    {
        $this->blogImages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDetail(): ?string
    {
        return $this->detail;
    }

    public function setDetail(string $detail): static
    {
        $this->detail = $detail;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return Collection<int, BlogImage>
     */
    public function getBlogImages(): Collection
    {
        return $this->blogImages;
    }

    public function addBlogImage(BlogImage $blogImage): static
    {
        if (!$this->blogImages->contains($blogImage)) {
            $this->blogImages->add($blogImage);
            $blogImage->setBlog($this);
        }

        return $this;
    }

    public function removeBlogImage(BlogImage $blogImage): static
    {
        if ($this->blogImages->removeElement($blogImage)) {
            // set the owning side to null (unless already changed)
            if ($blogImage->getBlog() === $this) {
                $blogImage->setBlog(null);
            }
        }

        return $this;
    }
}
