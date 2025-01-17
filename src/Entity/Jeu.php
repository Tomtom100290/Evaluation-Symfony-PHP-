<?php

namespace App\Entity;

use App\Repository\JeuRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JeuRepository::class)]
class Jeu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 45)]
    private ?string $NomJeu = null;

    #[ORM\Column]
    private ?int $NbParticipants = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomJeu(): ?string
    {
        return $this->NomJeu;
    }

    public function setNomJeu(string $NomJeu): static
    {
        $this->NomJeu = $NomJeu;

        return $this;
    }

    public function getNbParticipants(): ?int
    {
        return $this->NbParticipants;
    }

    public function setNbParticipants(int $NbParticipants): static
    {
        $this->NbParticipants = $NbParticipants;

        return $this;
    }
}
