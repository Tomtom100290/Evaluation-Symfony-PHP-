<?php

namespace App\Entity;

use App\Repository\EvenementRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EvenementRepository::class)]
class Evenement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 45)]
    private ?string $NomEvent = null;

    #[ORM\Column]
    private ?int $NbPartMax = null;

    #[ORM\Column(length: 45)]
    private ?string $Organisateur = null;

    #[ORM\Column(length: 255)]
    private ?string $Participants = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomEvent(): ?string
    {
        return $this->NomEvent;
    }

    public function setNomEvent(string $NomEvent): static
    {
        $this->NomEvent = $NomEvent;

        return $this;
    }

    public function getNbPartMax(): ?int
    {
        return $this->NbPartMax;
    }

    public function setNbPartMax(int $NbPartMax): static
    {
        $this->NbPartMax = $NbPartMax;

        return $this;
    }

    public function getOrganisateur(): ?string
    {
        return $this->Organisateur;
    }

    public function setOrganisateur(string $Organisateur): static
    {
        $this->Organisateur = $Organisateur;

        return $this;
    }

    public function getParticipants(): ?string
    {
        return $this->Participants;
    }

    public function setParticipants(string $Participants): static
    {
        $this->Participants = $Participants;

        return $this;
    }
}
