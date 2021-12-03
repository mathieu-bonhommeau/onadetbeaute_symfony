<?php

namespace App\Entity;

use App\Repository\PrestationTypeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PrestationTypeRepository::class)
 */
class PrestationType
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
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\OneToOne(targetEntity=Photo::class, inversedBy="prestationType", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $photoInPromote;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPhotoInPromote(): ?Photo
    {
        return $this->photoInPromote;
    }

    public function setPhotoInPromote(Photo $photoInPromote): self
    {
        $this->photoInPromote = $photoInPromote;

        return $this;
    }
}
