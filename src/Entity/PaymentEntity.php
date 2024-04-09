<?php

namespace App\Entity;

use App\Repository\PaymentEntityRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PaymentEntityRepository::class)]
class PaymentEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?PaymentMethodEntity $paymentMethod = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?StateEntity $state = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPaymentMethod(): ?PaymentMethodEntity
    {
        return $this->paymentMethod;
    }

    public function setPaymentMethod(?PaymentMethodEntity $paymentMethod): static
    {
        $this->paymentMethod = $paymentMethod;

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
}
