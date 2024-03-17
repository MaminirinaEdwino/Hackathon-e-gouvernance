<?php

namespace App\Entity;

use App\Repository\UtilisateursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UtilisateursRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_C_I_N', fields: ['CIN'])]
class Utilisateurs implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $CIN = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_naissance = null;

    #[ORM\Column]
    private ?int $age = null;

    #[ORM\Column]
    private ?bool $sexe = null;

    #[ORM\Column]
    private ?bool $status_matrimoniale = null;

    #[ORM\Column]
    private ?bool $vivant = null;

    #[ORM\Column]
    private ?int $profession = null;

    #[ORM\Column(length: 255)]
    private ?string $lieu_naissance = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'pere')]
    private ?self $pere = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'mere')]
    private ?self $mere = null;

    #[ORM\OneToOne(targetEntity: self::class, cascade: ['persist', 'remove'])]
    private ?self $partenaire = null;

    #[ORM\OneToMany(targetEntity: Naissance::class, mappedBy: 'pere')]
    private Collection $naissances;

    #[ORM\OneToMany(targetEntity: Mariage::class, mappedBy: 'demandeur')]
    private Collection $demande_mariage;

    #[ORM\OneToMany(targetEntity: Deces::class, mappedBy: 'demandeur')]
    private Collection $demande_dece;

    #[ORM\OneToMany(targetEntity: Naissance::class, mappedBy: 'demandeur')]
    private Collection $declaration_naissance;

    #[ORM\OneToMany(targetEntity: Naissance::class, mappedBy: 'demadeur_acte')]
    private Collection $demande_acte;

    #[ORM\OneToMany(targetEntity: CertificationLegalisation::class, mappedBy: 'demandeur')]
    private Collection $demande_certification_legalisation;

    #[ORM\OneToMany(targetEntity: Livret::class, mappedBy: 'demandeur')]
    private Collection $demandeLivret;

    #[ORM\ManyToOne(inversedBy: 'porteEmployes')]
    private ?Porte $porte = null;

    #[ORM\ManyToOne(inversedBy: 'professionEmployes')]
    private ?Profession $profession_employes = null;

    #[ORM\ManyToOne(inversedBy: 'utilisateurs')]
    private ?Quartier $adresse = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\OneToMany(targetEntity: Deces::class, mappedBy: 'demandeur_acte')]
    private Collection $demandeur_acte;

    public function __construct()
    {
        $this->demandeur_acte = new ArrayCollection();
    }

    /*public function __construct()
    {
        $this->pere = new ArrayCollection();
        $this->mere = new ArrayCollection();
        $this->naissances = new ArrayCollection();
        $this->demande_mariage = new ArrayCollection();
        $this->demande_dece = new ArrayCollection();
        $this->declaration_naissance = new ArrayCollection();
        $this->demande_acte = new ArrayCollection();
        $this->demande_certification_legalisation = new ArrayCollection();
        $this->demandeLivret = new ArrayCollection();
    }*/

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCIN(): ?string
    {
        return $this->CIN;
    }

    public function setCIN(string $CIN): static
    {
        $this->CIN = $CIN;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->CIN;
    }

    /**
     * @see UserInterface
     *
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->date_naissance;
    }

    public function setDateNaissance(\DateTimeInterface $date_naissance): static
    {
        $this->date_naissance = $date_naissance;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): static
    {
        $this->age = $age;

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

    public function isStatusMatrimoniale(): ?bool
    {
        return $this->status_matrimoniale;
    }

    public function setStatusMatrimoniale(bool $status_matrimoniale): static
    {
        $this->status_matrimoniale = $status_matrimoniale;

        return $this;
    }

    public function isVivant(): ?bool
    {
        return $this->vivant;
    }

    public function setVivant(bool $vivant): static
    {
        $this->vivant = $vivant;

        return $this;
    }

    public function getProfession(): ?int
    {
        return $this->profession;
    }

    public function setProfession(int $profession): static
    {
        $this->profession = $profession;

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

    public function getPere(): ?self
    {
        return $this->pere;
    }

    public function setPere(?self $pere): static
    {
        $this->pere = $pere;

        return $this;
    }

    public function getMere(): ?self
    {
        return $this->mere;
    }

    public function setMere(?self $mere): static
    {
        $this->mere = $mere;

        return $this;
    }

    public function getPartenaire(): ?self
    {
        return $this->partenaire;
    }

    public function setPartenaire(?self $partenaire): static
    {
        $this->partenaire = $partenaire;

        return $this;
    }

    /**
     * @return Collection<int, Naissance>
     */
    public function getNaissances(): Collection
    {
        return $this->naissances;
    }

    public function addNaissance(Naissance $naissance): static
    {
        if (!$this->naissances->contains($naissance)) {
            $this->naissances->add($naissance);
            $naissance->setPere($this);
        }

        return $this;
    }

    public function removeNaissance(Naissance $naissance): static
    {
        if ($this->naissances->removeElement($naissance)) {
            // set the owning side to null (unless already changed)
            if ($naissance->getPere() === $this) {
                $naissance->setPere(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Mariage>
     */
    public function getDemandeMariage(): Collection
    {
        return $this->demande_mariage;
    }

    public function addDemandeMariage(Mariage $demandeMariage): static
    {
        if (!$this->demande_mariage->contains($demandeMariage)) {
            $this->demande_mariage->add($demandeMariage);
            $demandeMariage->setDemandeur($this);
        }

        return $this;
    }

    public function removeDemandeMariage(Mariage $demandeMariage): static
    {
        if ($this->demande_mariage->removeElement($demandeMariage)) {
            // set the owning side to null (unless already changed)
            if ($demandeMariage->getDemandeur() === $this) {
                $demandeMariage->setDemandeur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Deces>
     */
    public function getDemandeDece(): Collection
    {
        return $this->demande_dece;
    }

    public function addDemandeDece(Deces $demandeDece): static
    {
        if (!$this->demande_dece->contains($demandeDece)) {
            $this->demande_dece->add($demandeDece);
            $demandeDece->setDemandeur($this);
        }

        return $this;
    }

    public function removeDemandeDece(Deces $demandeDece): static
    {
        if ($this->demande_dece->removeElement($demandeDece)) {
            // set the owning side to null (unless already changed)
            if ($demandeDece->getDemandeur() === $this) {
                $demandeDece->setDemandeur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Naissance>
     */
    public function getDeclarationNaissance(): Collection
    {
        return $this->declaration_naissance;
    }

    public function addDeclarationNaissance(Naissance $declarationNaissance): static
    {
        if (!$this->declaration_naissance->contains($declarationNaissance)) {
            $this->declaration_naissance->add($declarationNaissance);
            $declarationNaissance->setDemandeur($this);
        }

        return $this;
    }

    public function removeDeclarationNaissance(Naissance $declarationNaissance): static
    {
        if ($this->declaration_naissance->removeElement($declarationNaissance)) {
            // set the owning side to null (unless already changed)
            if ($declarationNaissance->getDemandeur() === $this) {
                $declarationNaissance->setDemandeur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Naissance>
     */
    public function getDemandeActe(): Collection
    {
        return $this->demande_acte;
    }

    public function addDemandeActe(Naissance $demandeActe): static
    {
        if (!$this->demande_acte->contains($demandeActe)) {
            $this->demande_acte->add($demandeActe);
            $demandeActe->setDemadeurActe($this);
        }

        return $this;
    }

    public function removeDemandeActe(Naissance $demandeActe): static
    {
        if ($this->demande_acte->removeElement($demandeActe)) {
            // set the owning side to null (unless already changed)
            if ($demandeActe->getDemadeurActe() === $this) {
                $demandeActe->setDemadeurActe(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CertificationLegalisation>
     */
    public function getDemandeCertificationLegalisation(): Collection
    {
        return $this->demande_certification_legalisation;
    }

    public function addDemandeCertificationLegalisation(CertificationLegalisation $demandeCertificationLegalisation): static
    {
        if (!$this->demande_certification_legalisation->contains($demandeCertificationLegalisation)) {
            $this->demande_certification_legalisation->add($demandeCertificationLegalisation);
            $demandeCertificationLegalisation->setDemandeur($this);
        }

        return $this;
    }

    public function removeDemandeCertificationLegalisation(CertificationLegalisation $demandeCertificationLegalisation): static
    {
        if ($this->demande_certification_legalisation->removeElement($demandeCertificationLegalisation)) {
            // set the owning side to null (unless already changed)
            if ($demandeCertificationLegalisation->getDemandeur() === $this) {
                $demandeCertificationLegalisation->setDemandeur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Livret>
     */
    public function getDemandeLivret(): Collection
    {
        return $this->demandeLivret;
    }

    public function addDemandeLivret(Livret $demandeLivret): static
    {
        if (!$this->demandeLivret->contains($demandeLivret)) {
            $this->demandeLivret->add($demandeLivret);
            $demandeLivret->setDemandeur($this);
        }

        return $this;
    }

    public function removeDemandeLivret(Livret $demandeLivret): static
    {
        if ($this->demandeLivret->removeElement($demandeLivret)) {
            // set the owning side to null (unless already changed)
            if ($demandeLivret->getDemandeur() === $this) {
                $demandeLivret->setDemandeur(null);
            }
        }

        return $this;
    }

    public function getPorte(): ?Porte
    {
        return $this->porte;
    }

    public function setPorte(?Porte $porte): static
    {
        $this->porte = $porte;

        return $this;
    }

    public function getProfessionEmployes(): ?Profession
    {
        return $this->profession_employes;
    }

    public function setProfessionEmployes(?Profession $profession_employes): static
    {
        $this->profession_employes = $profession_employes;

        return $this;
    }

    public function getAdresse(): ?Quartier
    {
        return $this->adresse;
    }

    public function setAdresse(?Quartier $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }
    public function __toString()
    {
        return $this->nom. ' ' .$this->prenom;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, Deces>
     */
    public function getDemandeurActe(): Collection
    {
        return $this->demandeur_acte;
    }

    public function addDemandeurActe(Deces $demandeurActe): static
    {
        if (!$this->demandeur_acte->contains($demandeurActe)) {
            $this->demandeur_acte->add($demandeurActe);
            $demandeurActe->setDemandeurActe($this);
        }

        return $this;
    }

    public function removeDemandeurActe(Deces $demandeurActe): static
    {
        if ($this->demandeur_acte->removeElement($demandeurActe)) {
            // set the owning side to null (unless already changed)
            if ($demandeurActe->getDemandeurActe() === $this) {
                $demandeurActe->setDemandeurActe(null);
            }
        }

        return $this;
    }

}
