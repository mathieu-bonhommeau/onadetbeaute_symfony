<?php

namespace App\Entity;

use App\Repository\OnadEtBeauteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OnadEtBeauteRepository::class)
 */
class OnadEtBeaute
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
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $siret;

    /**
     * @ORM\Column(type="text")
     */
    private $aboutMe;

    /**
     * @ORM\Column(type="text")
     */
    private $aboutMyActivity;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $facebookToken;

    /**
     * @ORM\Column(type="bigint")
     */
    private $facebookClientId;

    /**
     * @ORM\Column(type="bigint")
     */
    private $facebookUserId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $facebookClientSecret;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $facebookRedirectUri;

    /**
     * @ORM\Column(type="bigint")
     */
    private $facebookPageId;

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
        if (!preg_match('#^([a-zA-Z0-9-.]{2,})@([a-zA-Z]+)\.[a-z]{2,4}#', $email)) {
            throw new \Exception("Cet email n'est pas valide");
        }

        $this->email = $email;
        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        if ($firstname === '') {
            throw new \Exception('Cet élément ne peut être vide');
        }
        $this->firstname = $firstname;

        return $this;
    }

 
    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        if ($lastname === '') {
            throw new \Exception('Cet élément ne peut être vide');
        }
        $this->lastname = $lastname;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        if ($address === '') {
            throw new \Exception('Cet élément ne peut être vide');
        }
        $this->address = $address;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        if ($phone === '') {
            throw new \Exception('Cet élément ne peut être vide');
        }
        $this->phone = $phone;

        return $this;
    }

    public function getSiret(): ?string
    {
        return $this->siret;
    }

    public function setSiret(?string $siret): self
    {
        $this->siret = $siret;

        return $this;
    }

    public function getAboutMe(): ?string
    {
        return $this->aboutMe;
    }

    public function setAboutMe(string $aboutMe): self
    {
        if ($aboutMe === '') {
            throw new \Exception('Cet élément ne peut être vide');
        }
        $this->aboutMe = $aboutMe;

        return $this;
    }

    public function getAboutMyActivity(): ?string
    {
        return $this->aboutMyActivity;
    }

    public function setAboutMyActivity(string $aboutMyActivity): self
    {
        if ($aboutMyActivity === '') {
            throw new \Exception('Cet élément ne peut être vide');
        }
        $this->aboutMyActivity = $aboutMyActivity;

        return $this;
    }

    public function getFacebookToken(): ?string
    {
        return $this->facebookToken;
    }

    public function setFacebookToken(?string $facebookToken): self
    {
        $this->facebookToken = $facebookToken;

        return $this;
    }

    public function getFacebookClientId(): ?int
    {
        return $this->facebookClientId;
    }

    public function setFacebookClientId(int $facebookClientId): self
    {
        $this->facebookClientId = $facebookClientId;

        return $this;
    }

    public function getFacebookUserId(): ?int
    {
        return $this->facebookUserId;
    }

    public function setFacebookUserId(int $facebookUserId): self
    {
        $this->facebookUserId = $facebookUserId;

        return $this;
    }

    public function getFacebookClientSecret(): ?string
    {
        return $this->facebookClientSecret;
    }

    public function setFacebookClientSecret(string $facebookClientSecret): self
    {
        $this->facebookClientSecret = $facebookClientSecret;

        return $this;
    }

    public function getFacebookRedirectUri(): ?string
    {
        return $this->facebookRedirectUri;
    }

    public function setFacebookRedirectUri(string $facebookRedirectUri): self
    {
        $this->facebookRedirectUri = $facebookRedirectUri;

        return $this;
    }

    public function getFacebookPageId(): ?int
    {
        return $this->facebookPageId;
    }

    public function setFacebookPageId(int $facebookPageId): self
    {
        $this->facebookPageId = $facebookPageId;

        return $this;
    }
}
