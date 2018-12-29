<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AvisRepository")
 */
class Avis
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
    private $fullName;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;


    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;


    /**
     * @ORM\Column(type="float")
     */
    private $rating;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Produit", inversedBy="avis")
     */
    private $produit;

    public function getId() : ? int
    {
        return $this->id;
    }

    public function getRating() : ? float
    {
        return $this->rating;
    }

    public function setRating(float $rating) : self
    {
        $this->rating = $rating;

        return $this;
    }

    public function getProduit() : ? Produit
    {
        return $this->produit;
    }

    public function setProduit(? Produit $produit) : self
    {
        $this->produit = $produit;

        return $this;
    }

    public function getFullName() : ? string
    {
        return $this->fullName;
    }

    public function setFullName(string $fullName) : self
    {
        $this->fullName = $fullName;

        return $this;
    }

    public function getEmail() : ? string
    {
        return $this->email;
    }

    public function setEmail(string $email) : self
    {
        $this->email = $email;

        return $this;
    }

    public function getDescription() : ? string
    {
        return $this->description;
    }

    public function setDescription(? string $description) : self
    {
        $this->description = $description;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
