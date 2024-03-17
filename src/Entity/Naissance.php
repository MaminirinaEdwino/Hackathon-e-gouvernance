<?php

namespace App\Entity;

use App\Repository\NaissanceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NaissanceRepository::class)]
class Naissance
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column]
    private ?bool $sexe = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_naissance = null;

    #[ORM\Column(length: 255)]
    private ?string $lieu_naissance = null;

    #[ORM\ManyToOne(inversedBy: 'naissances')]
    private ?Utilisateurs $pere = null;

    #[ORM\ManyToOne(inversedBy: 'naissances')]
    private ?Utilisateurs $mere = null;

    #[ORM\ManyToOne(inversedBy: 'declaration_naissance')]
    private ?Utilisateurs $demandeur = null;

    #[ORM\ManyToOne(inversedBy: 'demande_acte')]
    private ?Utilisateurs $demadeur_acte = null;

    #[ORM\Column(length: 255, nullable:true)]
    private ?string $fichier_retour = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable:true)]
    private ?\DateTimeInterface $dateDemande = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateRetour = null;

    #[ORM\Column]
    private ?bool $confirmer = null;

    #[ORM\Column]
    private ?int $num_porte = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function isSexe(): ?bool
    {
        return $this->sexe;
    }

    public function setSexe(bool $sexe): static
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->date_naissance;
    }

    public function setDateNaissance(\DateTimeInterface $date_naissance): static
    {
        $this->date_naissance = $date_naissance;

        return $this;
    }

    public function getLieuNaissance(): ?string
    {
        return $this->lieu_naissance;
    }

    public function setLieuNaissance(string $lieu_naissance): static
    {
        $this->lieu_naissance = $lieu_naissance;

        return $this;
    }

    public function getPere(): ?Utilisateurs
    {
        return $this->pere;
    }

    public function setPere(?Utilisateurs $pere): static
    {
        $this->pere = $pere;

        return $this;
    }

    public function getMere(): ?Utilisateurs
    {
        return $this->mere;
    }

    public function setMere(?Utilisateurs $mere): static
    {
        $this->mere = $mere;

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

    public function getDemadeurActe(): ?Utilisateurs
    {
        return $this->demadeur_acte;
    }

    public function setDemadeurActe(?Utilisateurs $demadeur_acte): static
    {
        $this->demadeur_acte = $demadeur_acte;

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

    public function isConfirmer(): ?bool
    {
        return $this->confirmer;
    }

    public function setConfirmer(bool $confirmer): static
    {
        $this->confirmer = $confirmer;

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
