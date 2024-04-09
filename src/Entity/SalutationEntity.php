<?php

namespace App\Entity;

use App\Repository\SalutationEntityRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SalutationEntityRepository::class)]
class SalutationEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 64)]
    private ?string $salutation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSalutation(): ?string
    {
        return $this->salutation;
    }

    public function setSalutation(string $salutation): static
    {
        $this->salutation = $salutation;

        return $this;
    }
}
