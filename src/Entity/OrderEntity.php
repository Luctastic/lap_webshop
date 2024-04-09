<?php

namespace App\Entity;

use App\Repository\OrderEntityRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderEntityRepository::class)]
class OrderEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?PaymentEntity $payment = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?StateEntity $state = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?BasketEntity $basket = null;

    #[ORM\ManyToOne(inversedBy: 'orderEntities')]
    #[ORM\JoinColumn(nullable: false)]
    private ?CustomerEntity $customer = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?DeliveryEntity $delivery = null;

    // note: createdAt not implemented yet

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPayment(): ?PaymentEntity
    {
        return $this->payment;
    }

    public function setPayment(PaymentEntity $payment): static
    {
        $this->payment = $payment;

        return $this;
    }

    public function getState(): ?StateEntity
    {
        return $this->state;
    }

    public function setState(?StateEntity $state): static
    {
        $this->state = $state;

        return $this;
    }

    public function getBasket(): ?BasketEntity
    {
        return $this->basket;
    }

    public function setBasket(BasketEntity $basket): static
    {
        $this->basket = $basket;

        return $this;
    }

    public function getCustomer(): ?CustomerEntity
    {
        return $this->customer;
    }

    public function setCustomer(?CustomerEntity $customer): static
    {
        $this->customer = $customer;

        return $this;
    }

    public function getDelivery(): ?DeliveryEntity
    {
        return $this->delivery;
    }

    public function setDelivery(DeliveryEntity $delivery): static
    {
        $this->delivery = $delivery;

        return $this;
    }
}
