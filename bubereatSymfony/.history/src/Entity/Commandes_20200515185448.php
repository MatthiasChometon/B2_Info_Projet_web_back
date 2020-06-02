<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 * )
 * @ORM\Entity(repositoryClass="App\Repository\CommandesRepository")
 */
class Commandes
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Formules", mappedBy="commandes")
     * @Groups({"user_informations", "restaurants_informations"})
     */
    private $formules;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("user_informations")
     */
    private $state;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Restaurants", mappedBy="commandes")
     */
    private $restaurants;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="commandes")
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("user_informations")
     */
    private $address;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Plats", mappedBy="commandes")
     * @Groups("user_informations")
     */
    private $plats;

    public function __construct()
    {
        $this->formules = new ArrayCollection();
        $this->restaurants = new ArrayCollection();
        $this->Plats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    /**
     * @return Collection|Formules[]
     */
    public function getFormules(): Collection
    {
        return $this->formules;
    }

    public function addFormule(Formules $formule): self
    {
        if (!$this->formules->contains($formule)) {
            $this->formules[] = $formule;
            $formule->addCommande($this);
        }

        return $this;
    }

    public function removeFormule(Formules $formule): self
    {
        if ($this->formules->contains($formule)) {
            $this->formules->removeElement($formule);
            $formule->removeCommande($this);
        }

        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(string $state): self
    {
        $this->state = $state;

        return $this;
    }

    /**
     * @return Collection|Restaurants[]
     */
    public function getRestaurants(): Collection
    {
        return $this->restaurants;
    }

    public function addRestaurant(Restaurants $restaurant): self
    {
        if (!$this->restaurants->contains($restaurant)) {
            $this->restaurants[] = $restaurant;
            $restaurant->addCommande($this);
        }

        return $this;
    }

    public function removeRestaurant(Restaurants $restaurant): self
    {
        if ($this->restaurants->contains($restaurant)) {
            $this->restaurants->removeElement($restaurant);
            $restaurant->removeCommande($this);
        }

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

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return Collection|Plats[]
     */
    public function getPLats(): Collection
    {
        return $this->plats;
    }

    public function addPLat(Plats $pLat): self
    {
        if (!$this->plats->contains($pLat)) {
            $this->plats[] = $pLat;
            $pLat->setCommandes($this);
        }

        return $this;
    }

    public function removePLat(Plats $pLat): self
    {
        if ($this->plats->contains($pLat)) {
            $this->plats->removeElement($pLat);
            // set the owning side to null (unless already changed)
            if ($pLat->getCommandes() === $this) {
                $pLat->setCommandes(null);
            }
        }

        return $this;
    }
}
