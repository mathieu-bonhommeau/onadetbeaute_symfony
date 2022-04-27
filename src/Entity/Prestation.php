<?php

namespace App\Entity;

use App\Repository\PrestationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PrestationRepository::class)
 * @ORM\Table(name="prestation")
 */
class Prestation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\OneToOne(targetEntity=Photo::class, inversedBy="prestation")
     */
    private $photoInPromote;

    /**
     * @ORM\ManyToOne(targetEntity=PrestationType::class, inversedBy="prestations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $prestationType;


    public function __toString()
    {
        return $this->name;
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
        if ($name === '') {
            throw new \Exception('Cet élément ne peut être vide');
        }
        $this->name = $name;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        if ($price < 0) {
            $price = $price * (-1);
        }
        $this->price = $price;

        return $this;
    }

    public function getPhotoInPromote(): ?Photo
    {
        return $this->photoInPromote;
    }

    public function setPhotoInPromote(?Photo $photoInPromote): self
    {
        $this->photoInPromote = $photoInPromote;

        return $this;
    }

    public function getPrestationType(): ?PrestationType
    {
        return $this->prestationType;
    }

    public function setPrestationType(?PrestationType $prestationType): self
    {
        $this->prestationType = $prestationType;

        return $this;
    }
}
