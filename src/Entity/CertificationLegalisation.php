<?php

namespace App\Entity;

use App\Repository\CertificationLegalisationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CertificationLegalisationRepository::class)]
class CertificationLegalisation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $non_legalise = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $legalise = null;

    #[ORM\ManyToOne(inversedBy: 'demande_certification_legalisation')]
    private ?Utilisateurs $demandeur = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateDemande = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateRetour = null;

    #[ORM\Column]
    private ?bool $confirmation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNonLegalise(): ?string
    {
        return $this->non_legalise;
    }

    public function setNonLegalise(string $non_legalise): static
    {
        $this->non_legalise = $non_legalise;

        return $this;
    }

    public function getLegalise(): ?string
    {
        return $this->legalise;
    }

    public function setLegalise(string $legalise): static
    {
        $this->legalise = $legalise;

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
}
