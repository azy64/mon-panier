<?php

namespace App\Entity;

use App\Repository\CouleursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CouleursRepository::class)
 */
class Couleurs
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $codecouleur;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libele;

    /**
     * @ORM\OneToMany(targetEntity=Variants::class, mappedBy="couleur", orphanRemoval=true)
     */
    private $variants;

    public function __construct()
    {
        $this->variants = new ArrayCollection();
    }

    
    public function __toString()
    {
        return $this->getLibele();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodecouleur(): ?int
    {
        return $this->codecouleur;
    }

    public function setCodecouleur(int $codecouleur): self
    {
        $this->codecouleur = $codecouleur;

        return $this;
    }

    

    public function getLibele(): ?string
    {
        return $this->libele;
    }

    public function setLibele(string $libele): self
    {
        $this->libele = $libele;

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
            $variant->setCouleur($this);
        }

        return $this;
    }

    public function removeVariant(Variants $variant): self
    {
        if ($this->variants->removeElement($variant)) {
            // set the owning side to null (unless already changed)
            if ($variant->getCouleur() === $this) {
                $variant->setCouleur(null);
            }
        }

        return $this;
    }
}
