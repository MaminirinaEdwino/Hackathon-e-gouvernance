<?php

namespace App\Entity;

use App\Repository\MariageRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MariageRepository::class)]
class Mariage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $cin = null;

    #[ORM\ManyToOne(inversedBy: 'demande_mariage')]
    private ?Utilisateurs $demandeur = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $fichier_retour = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateDemande = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateRetour = null;

    #[ORM\Column]
    private ?bool $confirmation = null;

    #[ORM\Column]
    private ?int $num_porte = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCin(): ?string
    {
        return $this->cin;
    }

    public function setCin(string $cin): static
    {
        $this->cin = $cin;

        return $this;
    }

    public function getDemandeur(): ?Utilisateurs
    {
        return $this->demandeur;
    }

    public function setDemandeur(?Utilisateurs $demandeur): static
    {
        $this->demandeur = $demandeur;

        return $this;
    }

    public function getFichierRetour(): ?string
    {
        return $this->fichier_retour;
    }

    public function setFichierRetour(string $fichier_retour): static
    {
        $this->fichier_retour = $fichier_retour;

        return $this;
    }

    public function getDateDemande(): ?\DateTimeInterface
    {
        return $this->dateDemande;
    }

    public function setDateDemande(\DateTimeInterface $dateDemande): static
    {
        $this->dateDemande = $dateDemande;

        return $this;
    }

    public function getDateRetour(): ?\DateTimeInterface
    {
        return $this->dateRetour;
    }

    public function setDateRetour(?\DateTimeInterface $dateRetour): static
    {
        $this->dateRetour = $dateRetour;

        return $this;
    }

    public function isConfirmation(): ?bool
    {
        return $this->confirmation;
    }

    public function setConfirmation(bool $confirmation): static
    {
        $this->confirmation = $confirmation;

        return $this;
    }

    public function getNumPorte(): ?int
    {
        return $this->num_porte;
    }

    public function setNumPorte(int $num_porte): static
    {
        $this->num_porte = $num_porte;

        return $this;
    }
}
