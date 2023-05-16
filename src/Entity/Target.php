<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\TargetRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TargetRepository::class)]
#[ApiResource]
class Target
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $rank = null;

    #[ORM\ManyToOne(inversedBy: 'targets')]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRank(): ?string
    {
        return $this->rank;
    }

    public function setRank(?string $rank): self
    {
        $this->rank = $rank;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
   
}
