<?php

namespace App\Entity;

use App\Repository\CountryEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CountryEntityRepository::class)]
class CountryEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 64)]
    private ?string $name = null;

    #[ORM\Column(length: 3)]
    private ?string $initials = null;

    /**
     * @var Collection<int, AddressEntity>
     */
    #[ORM\OneToMany(targetEntity: AddressEntity::class, mappedBy: 'country')]
    private Collection $addressEntities;

    public function __construct()
    {
        $this->addressEntities = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getInitials(): ?string
    {
        return $this->initials;
    }

    public function setInitials(string $initials): static
    {
        $this->initials = $initials;

        return $this;
    }

    /**
     * @return Collection<int, AddressEntity>
     */
    public function getAddressEntities(): Collection
    {
        return $this->addressEntities;
    }

    public function addAddressEntity(AddressEntity $addressEntity): static
    {
        if (!$this->addressEntities->contains($addressEntity)) {
            $this->addressEntities->add($addressEntity);
            $addressEntity->setCountry($this);
        }

        return $this;
    }

    public function removeAddressEntity(AddressEntity $addressEntity): static
    {
        if ($this->addressEntities->removeElement($addressEntity)) {
            // set the owning side to null (unless already changed)
            if ($addressEntity->getCountry() === $this) {
                $addressEntity->setCountry(null);
            }
        }

        return $this;
    }
}
