<?php

namespace App\Entity;

use App\Repository\ProfessionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProfessionRepository::class)]
class Profession
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre_profession = null;

    #[ORM\Column(length: 255)]
    private ?string $porte = null;

    #[ORM\OneToMany(targetEntity: Employes::class, mappedBy: 'profession')]
    private Collection $employes;

    #[ORM\OneToMany(targetEntity: Utilisateurs::class, mappedBy: 'profession_employes')]
    private Collection $professionEmployes;

    public function __construct()
    {
        $this->employes = new ArrayCollection();
        $this->professionEmployes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitreProfession(): ?string
    {
        return $this->titre_profession;
    }

    public function setTitreProfession(string $titre_profession): static
    {
        $this->titre_profession = $titre_profession;

        return $this;
    }

    public function getPorte(): ?string
    {
        return $this->porte;
    }

    public function setPorte(string $porte): static
    {
        $this->porte = $porte;

        return $this;
    }

    /**
     * @return Collection<int, Employes>
     */
    public function getEmployes(): Collection
    {
        return $this->employes;
    }

    public function addEmploye(Employes $employe): static
    {
        if (!$this->employes->contains($employe)) {
            $this->employes->add($employe);
            $employe->setProfession($this);
        }

        return $this;
    }

    public function removeEmploye(Employes $employe): static
    {
        if ($this->employes->removeElement($employe)) {
            // set the owning side to null (unless already changed)
            if ($employe->getProfession() === $this) {
                $employe->setProfession(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Utilisateurs>
     */
    public function getProfessionEmployes(): Collection
    {
        return $this->professionEmployes;
    }

    public function addProfessionEmploye(Utilisateurs $professionEmploye): static
    {
        if (!$this->professionEmployes->contains($professionEmploye)) {
            $this->professionEmployes->add($professionEmploye);
            $professionEmploye->setProfessionEmployes($this);
        }

        return $this;
    }

    public function removeProfessionEmploye(Utilisateurs $professionEmploye): static
    {
        if ($this->professionEmployes->removeElement($professionEmploye)) {
            // set the owning side to null (unless already changed)
            if ($professionEmploye->getProfessionEmployes() === $this) {
                $professionEmploye->setProfessionEmployes(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->titre_profession;
    }
}
