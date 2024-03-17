<?php

namespace App\Entity;

use App\Repository\PorteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PorteRepository::class)]
class Porte
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $numero_porte = null;

    #[ORM\OneToMany(targetEntity: Service::class, mappedBy: 'porte')]
    private Collection $services;

    #[ORM\OneToMany(targetEntity: Employes::class, mappedBy: 'porte')]
    private Collection $employes;

    #[ORM\OneToMany(targetEntity: Utilisateurs::class, mappedBy: 'porte')]
    private Collection $porteEmployes;

    public function __construct()
    {
        $this->services = new ArrayCollection();
        $this->employes = new ArrayCollection();
        $this->porteEmployes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroPorte(): ?string
    {
        return $this->numero_porte;
    }

    public function setNumeroPorte(string $numero_porte): static
    {
        $this->numero_porte = $numero_porte;

        return $this;
    }

    /**
     * @return Collection<int, Service>
     */
    public function getServices(): Collection
    {
        return $this->services;
    }

    public function addService(Service $service): static
    {
        if (!$this->services->contains($service)) {
            $this->services->add($service);
            $service->setPorte($this);
        }

        return $this;
    }

    public function removeService(Service $service): static
    {
        if ($this->services->removeElement($service)) {
            // set the owning side to null (unless already changed)
            if ($service->getPorte() === $this) {
                $service->setPorte(null);
            }
        }

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
            $employe->setPorte($this);
        }

        return $this;
    }

    public function removeEmploye(Employes $employe): static
    {
        if ($this->employes->removeElement($employe)) {
            // set the owning side to null (unless already changed)
            if ($employe->getPorte() === $this) {
                $employe->setPorte(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Utilisateurs>
     */
    public function getPorteEmployes(): Collection
    {
        return $this->porteEmployes;
    }

    public function addPorteEmploye(Utilisateurs $porteEmploye): static
    {
        if (!$this->porteEmployes->contains($porteEmploye)) {
            $this->porteEmployes->add($porteEmploye);
            $porteEmploye->setPorte($this);
        }

        return $this;
    }

    public function removePorteEmploye(Utilisateurs $porteEmploye): static
    {
        if ($this->porteEmployes->removeElement($porteEmploye)) {
            // set the owning side to null (unless already changed)
            if ($porteEmploye->getPorte() === $this) {
                $porteEmploye->setPorte(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->numero_porte;
    }
}
