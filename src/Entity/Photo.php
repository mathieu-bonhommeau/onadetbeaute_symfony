<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\PhotoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PhotoRepository::class)
 * @ORM\Table(name="photo")
 * @ORM\HasLifecycleCallbacks()
 * @Vich\Uploadable
 */
class Photo
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"list-photos"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"list-photos"})
     */
    private $path;

    /**
     * @Vich\UploadableField(mapping="photos_images", fileNameProperty="path")
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $frontPhoto;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isMyWorksPhoto;

    /**
     * @ORM\OneToOne(targetEntity=PrestationType::class, mappedBy="photoInPromote")
     */
    private $prestationType;

    /**
     * @ORM\OneToMany(targetEntity=Prestation::class, mappedBy="photoInPromote")
     */
    private $prestations;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"list-photos"})
     */
    private $name;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $principalPhoto;

    /**
     * @ORM\Column(type="array", nullable=true)
     * @Groups({"list-photos"})
     */
    private $tags = [];

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"list-photos"})
     */
    private $date;

    public function __toString()
    {
        return $this->name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath($path): self
    {
        if ($path === '') {
            throw new \Exception('Cet élément ne peut être vide');
        }

        $this->path = $path;
        return $this;
    }

    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->createdAt = new \DateTime('now');
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
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

    /**
     * @return Collection
     */
    public function getPrestations(): Collection
    {
        return $this->prestations;
    }

    public function addPrestation(Prestation $prestation): self
    {
        if (!$this->prestations->contains($prestation)) {
            $this->prestations[] = $prestation;
            $prestation->setPrestationType($this);
        }

        return $this;
    }

    public function removePrestation(Prestation $prestation): self
    {
        if ($this->prestations->removeElement($prestation)) {
            // set the owning side to null (unless already changed)
            if ($prestation->getPrestationType() === $this) {
                $prestation->setPrestationType(null);
            }
        }

        return $this;
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

    public function getPrincipalPhoto(): ?bool
    {
        return $this->principalPhoto;
    }

    public function setPrincipalPhoto(?bool $principalPhoto): self
    {
        $this->principalPhoto = $principalPhoto;
        return $this;
    }

    public function getTags(): ?array
    {
        return $this->tags;
    }

    public function setTags(?array $tags): self
    {
        $this->tags = $tags;
        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;
        return $this;
    }

}
