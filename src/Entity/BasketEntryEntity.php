<?php

namespace App\Entity;

use App\Repository\BasketEntryEntityRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BasketEntryEntityRepository::class)]
class BasketEntryEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $quantity = null;

    #[ORM\ManyToOne(inversedBy: 'basketEntries')]
    #[ORM\JoinColumn(nullable: false)]
    private ?BasketEntity $basketEntity = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?ProductEntity $product = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getBasketEntity(): ?BasketEntity
    {
        return $this->basketEntity;
    }

    public function setBasketEntity(?BasketEntity $basketEntity): static
    {
        $this->basketEntity = $basketEntity;

        return $this;
    }

    public function getProduct(): ?ProductEntity
    {
        return $this->product;
    }

    public function setProduct(?ProductEntity $product): static
    {
        $this->product = $product;

        return $this;
    }
}
