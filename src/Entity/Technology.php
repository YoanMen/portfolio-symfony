<?php

namespace App\Entity;

use App\Repository\TechnologyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: TechnologyRepository::class)]
#[UniqueEntity('name')]
class Technology
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 40)]
    #[Assert\Length(min: 1, max: 40)]
    #[Assert\NotBlank()]
    private ?string $name = null;

    #[ORM\Column(length: 60)]
    #[Assert\Length(max: 60)]
    #[Assert\NotBlank()]
    private ?string $color = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    /**
     * @var Collection<int, Project>
     */
    #[ORM\ManyToMany(targetEntity: Project::class, inversedBy: 'technologies')]
    private Collection $projectID;

    public function __construct()
    {
        $this->projectID = new ArrayCollection();

        if ($this->createdAt == null) {
            $this->createdAt = new \DateTimeImmutable();
        }

        $this->updatedAt = new \DateTimeImmutable();
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

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): static
    {
        $this->color = $color;

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
}
