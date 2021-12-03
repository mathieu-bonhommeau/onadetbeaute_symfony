<?php

namespace App\Entity;

use App\Repository\PhotoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PhotoRepository::class)
 */
class Photo
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
    private $path;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $frontPhoto;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isMyWorksPhoto;

    /**
     * @ORM\OneToOne(targetEntity=PrestationType::class, mappedBy="photoInPromote", cascade={"persist", "remove"})
     */
    private $prestationType;

    /**
     * @ORM\ManyToOne(targetEntity=Prestation::class, inversedBy="photos")
     */
    private $prestation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): self
    {
        if ($path === '') {
            throw new \Exception('Cet élément ne peut être vide');
        }

        $this->path = $path;

        return $this;
    }

    public function getFrontPhoto(): ?bool
    {
        return $this->frontPhoto;
    }

    public function setFrontPhoto(?bool $frontPhoto): self
    {
        $this->frontPhoto = $frontPhoto;

        return $this;
    }

    public function getIsMyWorksPhoto(): ?bool
    {
        return $this->isMyWorksPhoto;
    }

    public function setIsMyWorksPhoto(?bool $isMyWorksPhoto): self
    {
        $this->isMyWorksPhoto = $isMyWorksPhoto;

        return $this;
    }

    public function getPrestationType(): ?PrestationType
    {
        return $this->prestationType;
    }

    public function setPrestationType(PrestationType $prestationType): self
    {
        // set the owning side of the relation if necessary
        if ($prestationType->getPhotoInPromote() !== $this) {
            $prestationType->setPhotoInPromote($this);
        }

        $this->prestationType = $prestationType;

        return $this;
    }

    public function getPrestation(): ?Prestation
    {
        return $this->prestation;
    }

    public function setPrestation(?Prestation $prestation): self
    {
        $this->prestation = $prestation;

        return $this;
    }

}
