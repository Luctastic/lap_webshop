<?php

namespace App\Entity;

use App\Repository\DeliveryEntityRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DeliveryEntityRepository::class)]
class DeliveryEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?StateEntity $state = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?DeliveryMethodEntity $deliveryMethod = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDeliveryMethod(): ?DeliveryMethodEntity
    {
        return $this->deliveryMethod;
    }

    public function setDeliveryMethod(?DeliveryMethodEntity $deliveryMethod): static
    {
        $this->deliveryMethod = $deliveryMethod;

        return $this;
    }
}
