<?php

namespace App\Entity;

use App\Repository\ProduitsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProduitsRepository::class)
 */
class Produits
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
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $marque;

    /**
     * @ORM\Column(type="string", length=9,unique=true)
     * 
     */
    private $reference;

    /**
     * @ORM\ManyToOne(targetEntity=TypeProduits::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity=Categorie::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $categorie;

    /**
     * @ORM\ManyToOne(targetEntity=Genres::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $genre;

    /**
     * @ORM\OneToMany(targetEntity=Variants::class, mappedBy="produit", orphanRemoval=true)
     */
    private $variants;

    public function __construct()
    {
        $this->variants = new ArrayCollection();
    }
    public function __toString()
    {
        return $this->getReference()."-".$this->getNom();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getType(): ?TypeProduits
    {
        return $this->type;
    }

    public function setType(?TypeProduits $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getGenre(): ?Genres
    {
        return $this->genre;
    }

    public function setGenre(?Genres $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * @return Collection|Variants[]
     */
    public function getVariants(): Collection
    {
        return $this->variants;
    }

    public function addVariant(Variants $variant): self
    {
        if (!$this->variants->contains($variant)) {
            $this->variants[] = $variant;
            $variant->setProduit($this);
        }

        return $this;
    }

    public function removeVariant(Variants $variant): self
    {
        if ($this->variants->removeElement($variant)) {
            // set the owning side to null (unless already changed)
            if ($variant->getProduit() === $this) {
                $variant->setProduit(null);
            }
        }

        return $this;
    }
}
