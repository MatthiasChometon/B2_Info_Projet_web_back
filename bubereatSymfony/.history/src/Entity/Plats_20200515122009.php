<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *  normalizationContext={"groups"={"plats"}}
 * )
 * @ORM\Entity(repositoryClass="App\Repository\PlatsRepository")
 */
class Plats
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups("plats")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("plats")
     */
    private $name;

    /**
     * @ORM\Column(type="float")
     * @Groups("plats")
     */
    private $price;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Formules", inversedBy="plats")
     * @Groups("plats")
     */
    private $formules;

    /**
     * @ORM\Column(type="text")
     * @Groups("plats")
     */
    private $description;

    /**
     * @ORM\Column(type="text")
     * @Groups("plats")
     */
    private $picture;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Restaurants", inversedBy="plats")
     * @Groups("plats")
     */
    private $restaurants;

    public function __construct()
    {
        $this->formules = new ArrayCollection();
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

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
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
        }

        return $this;
    }

    public function removeFormule(Formules $formule): self
    {
        if ($this->formules->contains($formule)) {
            $this->formules->removeElement($formule);
        }

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

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getRestaurants(): ?Restaurants
    {
        return $this->restaurants;
    }

    public function setRestaurants(?Restaurants $restaurants): self
    {
        $this->restaurants = $restaurants;

        return $this;
    }
}
