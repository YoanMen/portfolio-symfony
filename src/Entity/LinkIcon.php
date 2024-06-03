<?php

namespace App\Entity;

use App\Repository\LinkIconRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LinkIconRepository::class)]
class LinkIcon
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 120)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $icon = null;

    /**
     * @var Collection<int, Link>
     */
    #[ORM\OneToMany(targetEntity: Link::class, mappedBy: 'linkIcon', cascade: ['persist', 'remove'])]
    private Collection $link;

    public function __construct()
    {
        $this->link = new ArrayCollection();
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

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon(string $icon): static
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * @return Collection<int, Link>
     */
    public function getLink(): Collection
    {
        return $this->link;
    }

    public function addLink(Link $link): static
    {
        if (!$this->link->contains($link)) {
            $this->link->add($link);
            $link->setLinkIcon($this);
        }

        return $this;
    }

    public function removeLink(Link $link): static
    {
        if ($this->link->removeElement($link)) {
            // set the owning side to null (unless already changed)
            if ($link->getLinkIcon() === $this) {
                $link->setLinkIcon(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getIcon();
    }
}
