<?php

namespace App\Entity;

use App\Repository\PaniersRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PaniersRepository::class)
 */
class Paniers
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
    private $idClient;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateLivraison;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @ORM\ManyToOne(targetEntity=Variants::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $variant;

    /**
     * @ORM\ManyToOne(targetEntity=Tailles::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $taille;

    /**
     * @ORM\ManyToOne(targetEntity=Couleurs::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $couleur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdClient(): ?string
    {
        return $this->idClient;
    }

    public function setIdClient(string $idClient): self
    {
        $this->idClient = $idClient;

        return $this;
    }

    public function getDateLivraison(): ?\DateTimeInterface
    {
        return $this->dateLivraison;
    }

    public function setDateLivraison(\DateTimeInterface $dateLivraison): self
    {
        $this->dateLivraison = $dateLivraison;

        return $this;
    }


  
    public function __toString()
    {
        return $this->getVariant()->getProduit()->getNom();
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getVariant(): ?Variants
    {
        return $this->variant;
    }

    public function setVariant(?Variants $variant): self
    {
        $this->variant = $variant;

        return $this;
    }

    public function getTaille(): ?Tailles
    {
        return $this->taille;
    }

    public function setTaille(?Tailles $taille): self
    {
        $this->taille = $taille;

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
