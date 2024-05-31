<?php

namespace App\Entity;

use App\Repository\AuthAttemptRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AuthAttemptRepository::class)]
class AuthAttempt
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $attempt = null;

    #[ORM\Column(length: 120, nullable: false)]
    private ?string $ip = null;


    #[ORM\OneToOne(inversedBy: 'authAttempt', cascade: ['persist', 'remove'])]
    private ?User $user = null;

    #[ORM\Column(nullable: false)]
    private ?\DateTimeImmutable $attemptAt = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAttempt(): ?int
    {
        return $this->attempt;
    }

    public function setAttempt(int $attempt): static
    {
        $this->attempt = $attempt;

        return $this;
    }

    public function getIp(): ?string
    {
        return $this->ip;
    }

    public function setIp(?string $ip): static
    {
        $this->ip = $ip;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getAttemptAt(): ?\DateTimeImmutable
    {
        return $this->attemptAt;
    }

    public function setAttemptAt(\DateTimeImmutable $attemptAt): static
    {
        $this->attemptAt = $attemptAt;

        return $this;
    }
}
