<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImageRepository::class)]
class Image
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $path = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    /**
     * @var Collection<int, ProjectImage>
     */
    #[ORM\OneToMany(targetEntity: ProjectImage::class, mappedBy: 'imageID', orphanRemoval: true)]
    private Collection $projectImages;

    /**
     * @var Collection<int, BlogImage>
     */
    #[ORM\OneToMany(targetEntity: BlogImage::class, mappedBy: 'imageID', orphanRemoval: true)]
    private Collection $blogImages;

    public function __construct()
    {
        $this->projectImages = new ArrayCollection();
        $this->blogImages = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): static
    {
        $this->path = $path;

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
     * @return Collection<int, ProjectImage>
     */
    public function getProjectImages(): Collection
    {
        return $this->projectImages;
    }

    public function addProjectImage(ProjectImage $projectImage): static
    {
        if (!$this->projectImages->contains($projectImage)) {
            $this->projectImages->add($projectImage);
            $projectImage->setImageID($this);
        }

        return $this;
    }

    public function removeProjectImage(ProjectImage $projectImage): static
    {
        if ($this->projectImages->removeElement($projectImage)) {
            // set the owning side to null (unless already changed)
            if ($projectImage->getImageID() === $this) {
                $projectImage->setImageID(null);
            }
        }

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
            $blogImage->setImageID($this);
        }

        return $this;
    }

    public function removeBlogImage(BlogImage $blogImage): static
    {
        if ($this->blogImages->removeElement($blogImage)) {
            // set the owning side to null (unless already changed)
            if ($blogImage->getImageID() === $this) {
                $blogImage->setImageID(null);
            }
        }

        return $this;
    }
}
