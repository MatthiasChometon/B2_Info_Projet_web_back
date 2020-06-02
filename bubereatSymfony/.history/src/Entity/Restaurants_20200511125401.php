<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\RestaurantsRepository")
 */
class Restaurants
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Commandes", inversedBy="restaurants")
     */
    private $Commandes;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Formules", mappedBy="restaurants")
     */
    private $Formules;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="Restaurants")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="favoritRestaurants")
     */
    private $favoritRestaurants;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $picture;

    /**
     * @ORM\Column(type="boolean")
     */
    private $tendance;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="float")
     */
    private $stars;


    public function __construct()
    {
        $this->Commandes = new ArrayCollection();
        $this->Formules = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }



    /**
     * @return Collection|Commandes[]
     */
    public function getCommandes(): Collection
    {
        return $this->Commandes;
    }

    public function addCommande(Commandes $commande): self
    {
        if (!$this->Commandes->contains($commande)) {
            $this->Commandes[] = $commande;
        }

        return $this;
    }

    public function removeCommande(Commandes $commande): self
    {
        if ($this->Commandes->contains($commande)) {
            $this->Commandes->removeElement($commande);
        }

        return $this;
    }


    /**
     * @return Collection|Formules[]
     */
    public function getFormule(): Collection
    {
        return $this->Formules;
    }

    public function addFormule(Formules $formule): self
    {
        if (!$this->Formules->contains($formule)) {
            $this->Formules[] = $formule;
        }

        return $this;
    }

    public function removeFormule(Formules $formule): self
    {
        if ($this->Formules->contains($formule)) {
            $this->Formules->removeElement($formule);
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

    public function getFavoritRestaurants(): ?User
    {
        return $this->favoritRestaurants;
    }

    public function setFavoritRestaurants(?User $favoritRestaurants): self
    {
        $this->favoritRestaurants = $favoritRestaurants;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getTendance(): ?bool
    {
        return $this->tendance;
    }

    public function setTendance(bool $tendance): self
    {
        $this->tendance = $tendance;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getStars(): ?float
    {
        return $this->stars;
    }

    public function setStars(float $stars): self
    {
        $this->stars = $stars;

        return $this;
    }
}
