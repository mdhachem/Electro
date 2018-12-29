<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategorieRepository")
 */
class Categorie
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
    private $libelle;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Produit", mappedBy="categories")
     */
    private $produits;

    public function __construct()
    {
        $this->produits = new ArrayCollection();
    }

    public function getId() : ? int
    {
        return $this->id;
    }

    public function getLibelle() : ? string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle) : self
    {
        $this->libelle = $libelle;

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

    public function getImage() : ? string
    {
        return $this->image;
    }

    public function setImage(string $image) : self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection|Produit[]
     */
    public function getProduits() : Collection
    {
        return $this->produits;
    }

    public function addProduit(Produit $produit) : self
    {
        if (!$this->produits->contains($produit)) {
            $this->produits[] = $produit;
            $produit->addCategory($this);
        }

        return $this;
    }

    public function removeProduit(Produit $produit) : self
    {
        if ($this->produits->contains($produit)) {
            $this->produits->removeElement($produit);
            $produit->removeCategory($this);
        }

        return $this;
    }


    public function __toString()
    {
        return $this->libelle;
    }
}
