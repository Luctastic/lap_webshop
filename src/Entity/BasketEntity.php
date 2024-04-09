<?php

namespace App\Entity;

use App\Repository\BasketEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BasketEntityRepository::class)]
class BasketEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, BasketEntryEntity>
     */
    #[ORM\OneToMany(targetEntity: BasketEntryEntity::class, mappedBy: 'basketEntity')]
    private Collection $basketEntries;

    #[ORM\OneToOne(mappedBy: 'basket', cascade: ['persist', 'remove'])]
    private ?CustomerEntity $customerEntity = null;

    public function __construct()
    {
        $this->basketEntries = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, BasketEntryEntity>
     */
    public function getBasketEntries(): Collection
    {
        return $this->basketEntries;
    }

    public function addBasketEntry(BasketEntryEntity $basketEntry): static
    {
        if (!$this->basketEntries->contains($basketEntry)) {
            $this->basketEntries->add($basketEntry);
            $basketEntry->setBasketEntity($this);
        }

        return $this;
    }

    public function removeBasketEntry(BasketEntryEntity $basketEntry): static
    {
        if ($this->basketEntries->removeElement($basketEntry)) {
            // set the owning side to null (unless already changed)
            if ($basketEntry->getBasketEntity() === $this) {
                $basketEntry->setBasketEntity(null);
            }
        }

        return $this;
    }

    public function getCustomerEntity(): ?CustomerEntity
    {
        return $this->customerEntity;
    }

    public function setCustomerEntity(CustomerEntity $customerEntity): static
    {
        // set the owning side of the relation if necessary
        if ($customerEntity->getBasket() !== $this) {
            $customerEntity->setBasket($this);
        }

        $this->customerEntity = $customerEntity;

        return $this;
    }
}
