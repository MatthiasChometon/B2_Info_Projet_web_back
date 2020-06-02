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
    private $nom;

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


    public function __construct()
    {
        $this->Commandes = new ArrayCollection();
        $this->Formules = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

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
}
