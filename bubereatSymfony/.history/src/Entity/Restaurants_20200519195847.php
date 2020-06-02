<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 * normalizationContext={"groups"={"restaurants_informations"}}
 * )
 * @ORM\Entity(repositoryClass="App\Repository\RestaurantsRepository")
 */
class Restaurants
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"user_informations", "restaurants_informations"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user_informations", "restaurants_informations"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user_informations", "restaurants_informations"})
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user_informations", "restaurants_informations"})
     */
    private $adresse;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Commandes", inversedBy="restaurants")
     * @Groups({"restaurants_informations"})
     */
    private $Commandes;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Formules", mappedBy="restaurants")
     * @Groups({"restaurants_informations"})
     */
    private $Formules;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"restaurants_informations"})
     */
    private $picture;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"user_informations", "restaurants_informations"})
     */
    private $tendance;

    /**
     * @ORM\Column(type="text")
     * @Groups({"user_informations", "restaurants_informations"})
     */
    private $description;

    /**
     * @ORM\Column(type="float")
     * @Groups({"user_informations", "restaurants_informations"})
     */
    private $stars;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Plats", mappedBy="restaurants")
     * @Groups({"restaurants_informations"})
     */
    private $plats;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", mappedBy="favoritRestaurants")
     * @Groups({"restaurants_informations"})
     */
    private $usersFavorits;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="restaurants")
     * @Groups({"restaurants_informations"})
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    public function __construct()
    {
        $this->Commandes = new ArrayCollection();
        $this->Formules = new ArrayCollection();
        $this->plats = new ArrayCollection();
        $this->usersFavorits = new ArrayCollection();
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

    /**
     * @return Collection|Plats[]
     */
    public function getPlats(): Collection
    {
        return $this->plats;
    }

    public function addPlat(Plats $plat): self
    {
        if (!$this->plats->contains($plat)) {
            $this->plats[] = $plat;
            $plat->setRestaurants($this);
        }

        return $this;
    }

    public function removePlat(Plats $plat): self
    {
        if ($this->plats->contains($plat)) {
            $this->plats->removeElement($plat);
            // set the owning side to null (unless already changed)
            if ($plat->getRestaurants() === $this) {
                $plat->setRestaurants(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsersFavorits(): Collection
    {
        return $this->usersFavorits;
    }

    public function addUsersFavorit(User $usersFavorit): self
    {
        if (!$this->usersFavorits->contains($usersFavorit)) {
            $this->usersFavorits[] = $usersFavorit;
            $usersFavorit->addFavoritRestaurant($this);
        }

        return $this;
    }

    public function removeUsersFavorit(User $usersFavorit): self
    {
        if ($this->usersFavorits->contains($usersFavorit)) {
            $this->usersFavorits->removeElement($usersFavorit);
            $usersFavorit->removeFavoritRestaurant($this);
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }
}
