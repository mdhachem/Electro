<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProduitRepository")
 */
class Produit
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
     * @ORM\Column(type="string", length=255)
     */
    private $descriptionCourt;

    /**
     * @ORM\Column(type="text")
     */
    private $descriptionLong;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $imagePrincipale;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imageSecondaire1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imageSecondaire2;

    /**
     * @ORM\Column(type="float")
     */
    private $prix;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Categorie", inversedBy="produits")
     */
    private $categories;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\LigneCommande", mappedBy="produit")
     */
    private $ligneCommandes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Avis", mappedBy="produit")
     */
    private $avis;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->ligneCommandes = new ArrayCollection();
        $this->avis = new ArrayCollection();
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

    public function getDescriptionCourt() : ? string
    {
        return $this->descriptionCourt;
    }

    public function setDescriptionCourt(string $descriptionCourt) : self
    {
        $this->descriptionCourt = $descriptionCourt;

        return $this;
    }

    public function getDescriptionLong() : ? string
    {
        return $this->descriptionLong;
    }

    public function setDescriptionLong(string $descriptionLong) : self
    {
        $this->descriptionLong = $descriptionLong;

        return $this;
    }

    public function getImagePrincipale() : ? string
    {
        return $this->imagePrincipale;
    }

    public function setImagePrincipale(string $imagePrincipale) : self
    {
        $this->imagePrincipale = $imagePrincipale;

        return $this;
    }

    public function getImageSecondaire1() : ? string
    {
        return $this->imageSecondaire1;
    }

    public function setImageSecondaire1(? string $imageSecondaire1) : self
    {
        $this->imageSecondaire1 = $imageSecondaire1;

        return $this;
    }

    public function getImageSecondaire2() : ? string
    {
        return $this->imageSecondaire2;
    }

    public function setImageSecondaire2(? string $imageSecondaire2) : self
    {
        $this->imageSecondaire2 = $imageSecondaire2;

        return $this;
    }

    public function getPrix() : ? float
    {
        return $this->prix;
    }

    public function setPrix(float $prix) : self
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * @return Collection|Categorie[]
     */
    public function getCategories() : Collection
    {
        return $this->categories;
    }

    public function setCategories(array $categories)
    {
        return $this->categories = $categories;
    }

    public function addCategory(Categorie $category) : self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
        }

        return $this;
    }

    public function removeCategory(Categorie $category) : self
    {
        if ($this->categories->contains($category)) {
            $this->categories->removeElement($category);
        }

        return $this;
    }

    /**
     * @return Collection|LigneCommande[]
     */
    public function getLigneCommandes() : Collection
    {
        return $this->ligneCommandes;
    }

    public function addLigneCommande(LigneCommande $ligneCommande) : self
    {
        if (!$this->ligneCommandes->contains($ligneCommande)) {
            $this->ligneCommandes[] = $ligneCommande;
            $ligneCommande->setProduit($this);
        }

        return $this;
    }

    public function removeLigneCommande(LigneCommande $ligneCommande) : self
    {
        if ($this->ligneCommandes->contains($ligneCommande)) {
            $this->ligneCommandes->removeElement($ligneCommande);
            // set the owning side to null (unless already changed)
            if ($ligneCommande->getProduit() === $this) {
                $ligneCommande->setProduit(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Avis[]
     */
    public function getAvis() : Collection
    {
        return $this->avis;
    }

    public function addAvi(Avis $avi) : self
    {
        if (!$this->avis->contains($avi)) {
            $this->avis[] = $avi;
            $avi->setProduit($this);
        }

        return $this;
    }

    public function removeAvi(Avis $avi) : self
    {
        if ($this->avis->contains($avi)) {
            $this->avis->removeElement($avi);
            // set the owning side to null (unless already changed)
            if ($avi->getProduit() === $this) {
                $avi->setProduit(null);
            }
        }

        return $this;
    }


    public function __toString()
    {
        return $this->libelle;
    }
}
