<?php

namespace App\Entity;

use App\Repository\ProjectImageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjectImageRepository::class)]
class ProjectImage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'projectImages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Image $imageID = null;

    #[ORM\ManyToOne(inversedBy: 'projectImages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Project $projectID = null;

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

    public function getProjectID(): ?Project
    {
        return $this->projectID;
    }

    public function setProjectID(?Project $projectID): static
    {
        $this->projectID = $projectID;

        return $this;
    }
}
