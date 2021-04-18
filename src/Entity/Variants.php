<?php

namespace App\Entity;

use App\Repository\VariantsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VariantsRepository::class)
 */
class Variants
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;


   

    /**
     * @ORM\Column(type="float")
     */
    private $prix;

    /**
     * @ORM\Column(type="text")
     */
    private $photo;

    /**
     * @ORM\ManyToMany(targetEntity=Tailles::class, inversedBy="variants")
     */
    private $taille;

    /**
     * @ORM\ManyToOne(targetEntity=Produits::class, inversedBy="variants")
     * @ORM\JoinColumn(nullable=false)
     */
    private $produit;

    /**
     * @ORM\OneToOne(targetEntity=Stocks::class, mappedBy="variant", cascade={"persist", "remove"})
     */
    private $stock;

    /**
     * @ORM\ManyToOne(targetEntity=Couleurs::class, inversedBy="variants")
     * @ORM\JoinColumn(nullable=false)
     */
    private $couleur;
    
    public function __construct() {
        $this->taille =new ArrayCollection();
    }
    public function getId(): ?int
    {
        return $this->id;
    }
    public function __toString()
    {
        return $this->getProduit()->getNom();
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }
    public function setTaille($taille):self 
    {
        if($taille!==null)
            $this->taille=$taille;
        return $this;
    }

    /**
     * @return Collection|Tailles[]
     */
    public function getTaille(): Collection
    {
        return $this->taille;
    }

    public function addTaille(Tailles $taille): self
    {
        if (!$this->taille->contains($taille)) {
            $this->taille[] = $taille;
        }

        return $this;
    }

    public function removeTaille(Tailles $taille): self
    {
        $this->taille->removeElement($taille);

        return $this;
    }

    public function getProduit(): ?Produits
    {
        return $this->produit;
    }

    public function setProduit(?Produits $produit): self
    {
        $this->produit = $produit;

        return $this;
    }

    public function getStock(): ?Stocks
    {
        return $this->stock;
    }

    public function setStock(Stocks $stock): self
    {
        // set the owning side of the relation if necessary
        if ($stock->getVariant() !== $this) {
            $stock->setVariant($this);
        }

        $this->stock = $stock;

        return $this;
    }

    public function getCouleur(): ?Couleurs
    {
        return $this->couleur;
    }

    public function setCouleur(?Couleurs $couleur): self
    {
        $this->couleur = $couleur;

        return $this;
    }


    

    
}
