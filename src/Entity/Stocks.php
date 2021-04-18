<?php

namespace App\Entity;

use App\Repository\StocksRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StocksRepository::class)
 */
class Stocks
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
    private $quantite;

    /**
     * @ORM\OneToOne(targetEntity=Variants::class, inversedBy="stock", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $variant;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getVariant(): ?Variants
    {
        return $this->variant;
    }

    public function setVariant(Variants $variant): self
    {
        $this->variant = $variant;

        return $this;
    }
}
