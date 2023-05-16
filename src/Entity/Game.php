<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\GameRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GameRepository::class)]
#[ApiResource]
class Game
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $length = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column]
    private ?int $gold = null;

    #[ORM\Column]
    private ?int $teamkills = null;

    #[ORM\Column]
    private ?int $kills = null;

    #[ORM\Column]
    private ?int $deaths = null;

    #[ORM\Column]
    private ?int $assists = null;

    #[ORM\Column]
    private ?int $creepscore = null;

    #[ORM\Column]
    private ?int $visionscore = null;

    #[ORM\ManyToOne(inversedBy: 'games')]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLength(): ?string
    {
        return $this->length;
    }

    public function setLength(?string $length): self
    {
        $this->length = $length;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getGold(): ?int
    {
        return $this->gold;
    }

    public function setGold(int $gold): self
    {
        $this->gold = $gold;

        return $this;
    }

    public function getTeamkills(): ?int
    {
        return $this->teamkills;
    }

    public function setTeamkills(int $teamkills): self
    {
        $this->teamkills = $teamkills;

        return $this;
    }

    public function getKills(): ?int
    {
        return $this->kills;
    }

    public function setKills(int $kills): self
    {
        $this->kills = $kills;

        return $this;
    }

    public function getDeaths(): ?int
    {
        return $this->deaths;
    }

    public function setDeaths(int $deaths): self
    {
        $this->deaths = $deaths;

        return $this;
    }

    public function getAssists(): ?int
    {
        return $this->assists;
    }

    public function setAssists(int $assists): self
    {
        $this->assists = $assists;

        return $this;
    }

    public function getCreepscore(): ?int
    {
        return $this->creepscore;
    }

    public function setCreepscore(int $creepscore): self
    {
        $this->creepscore = $creepscore;

        return $this;
    }

    public function getVisionscore(): ?int
    {
        return $this->visionscore;
    }

    public function setVisionscore(int $visionscore): self
    {
        $this->visionscore = $visionscore;

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
