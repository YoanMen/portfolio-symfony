<?php

namespace App\Entity;

use App\Repository\LinkRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: LinkRepository::class)]
#[UniqueEntity('name')]
#[UniqueEntity('path')]

class Link
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(min: 3, max: 255)]
    #[Assert\NotBlank()]

    private ?string $path = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    /**
     * @var Collection<int, Project>
     */
    #[ORM\ManyToMany(targetEntity: Project::class, inversedBy: 'links')]
    private Collection $projectID;

    #[ORM\Column(length: 60)]
    #[Assert\NotBlank()]

    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'link')]
    private ?LinkIcon $linkIcon = null;



    public function __construct()
    {
        $this->projectID = new ArrayCollection();

        if ($this->getCreatedAt() === null) {
            $this->setCreatedAt(new \DateTimeImmutable());
        }
        $this->setUpdatedAt(new \DateTimeImmutable());
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
     * @return Collection<int, Project>
     */
    public function getProjectID(): Collection
    {
        return $this->projectID;
    }

    public function addProjectID(Project $projectID): static
    {
        if (!$this->projectID->contains($projectID)) {
            $this->projectID->add($projectID);
        }

        return $this;
    }

    public function removeProjectID(Project $projectID): static
    {
        $this->projectID->removeElement($projectID);

        return $this;
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


    public function getLinkIcon(): ?LinkIcon
    {
        return $this->linkIcon;
    }

    public function setLinkIcon(?LinkIcon $linkIcon): static
    {
        $this->linkIcon = $linkIcon;

        return $this;
    }

    public function __toString(): String
    {
        return $this->getName();
    }
}
