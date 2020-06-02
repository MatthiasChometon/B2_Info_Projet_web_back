<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 * normalizationContext={"groups"={"user_informations"}}
 * )
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups("user_informations")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Groups("user_informations")
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     * @Groups("user_informations")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     * @Groups("user_informations")
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Commandes", mappedBy="user")
     * @Groups("user_informations")
     */
    private $Commandes;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("user_informations")
     */
    private $surname;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Restaurants", mappedBy="user")
     * @Groups("user_informations")
     */
    private $Restaurants;

    /**
     * @ORM\Column(type="text")
     * @Groups("user_informations")
     */
    private $avatar;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\restaurants", inversedBy="usersFavorits")

     */
    private $favoritRestaurants;

    public function __construct()
    {
        $this->Commandes = new ArrayCollection();
        $this->Restaurants = new ArrayCollection();
        $this->favoritRestaurants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';
        // guarantee every user at least has ROLE_USER

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;


        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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
            $commande->setUser($this);
        }

        return $this;
    }

    public function removeCommande(Commandes $commande): self
    {
        if ($this->Commandes->contains($commande)) {
            $this->Commandes->removeElement($commande);
            // set the owning side to null (unless already changed)
            if ($commande->getUser() === $this) {
                $commande->setUser(null);
            }
        }

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * @return Collection|Restaurants[]
     */
    public function getRestaurants(): Collection
    {
        return $this->Restaurants;
    }

    public function addRestaurant(Restaurants $restaurant): self
    {
        if (!$this->Restaurants->contains($restaurant)) {
            $this->Restaurants[] = $restaurant;
            $restaurant->setUser($this);
        }

        return $this;
    }

    public function removeRestaurant(Restaurants $restaurant): self
    {
        if ($this->Restaurants->contains($restaurant)) {
            $this->Restaurants->removeElement($restaurant);
            // set the owning side to null (unless already changed)
            if ($restaurant->getUser() === $this) {
                $restaurant->setUser(null);
            }
        }

        return $this;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * @return Collection|restaurants[]
     */
    public function getFavoritRestaurants(): Collection
    {
        return $this->favoritRestaurants;
    }

    public function addFavoritRestaurant(restaurants $favoritRestaurant): self
    {
        if (!$this->favoritRestaurants->contains($favoritRestaurant)) {
            $this->favoritRestaurants[] = $favoritRestaurant;
        }

        return $this;
    }

    public function removeFavoritRestaurant(restaurants $favoritRestaurant): self
    {
        if ($this->favoritRestaurants->contains($favoritRestaurant)) {
            $this->favoritRestaurants->removeElement($favoritRestaurant);
        }

        return $this;
    }

}
