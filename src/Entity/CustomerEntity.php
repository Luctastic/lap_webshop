<?php

namespace App\Entity;

use App\Repository\CustomerEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: CustomerEntityRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class CustomerEntity implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $email = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 64)]
    private ?string $firstName = null;

    #[ORM\Column(length: 64)]
    private ?string $lastName = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?SalutationEntity $salutation = null;

    /**
     * @var Collection<int, AddressEntity>
     */
    #[ORM\OneToMany(targetEntity: AddressEntity::class, mappedBy: 'customerShippingEntity')]
    private Collection $shippingAddresses;

    /**
     * @var Collection<int, AddressEntity>
     */
    #[ORM\OneToMany(targetEntity: AddressEntity::class, mappedBy: 'customerBillingEntity')]
    private Collection $billingAddresses;

    /**
     * @var Collection<int, OrderEntity>
     */
    #[ORM\OneToMany(targetEntity: OrderEntity::class, mappedBy: 'customer')]
    private Collection $orderEntities;

    #[ORM\OneToOne(inversedBy: 'customerEntity', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?BasketEntity $basket = null;

    public function __construct()
    {
        $this->shippingAddresses = new ArrayCollection();
        $this->billingAddresses = new ArrayCollection();
        $this->orderEntities = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string)$this->email;
    }

    /**
     * @return list<string>
     * @see UserInterface
     *
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getSalutation(): ?SalutationEntity
    {
        return $this->salutation;
    }

    public function setSalutation(?SalutationEntity $salutation): static
    {
        $this->salutation = $salutation;

        return $this;
    }

    /**
     * @return Collection<int, AddressEntity>
     */
    public function getShippingAddresses(): Collection
    {
        return $this->shippingAddresses;
    }

    public function addShippingAddress(AddressEntity $shippingAddress): static
    {
        if (!$this->shippingAddresses->contains($shippingAddress)) {
            $this->shippingAddresses->add($shippingAddress);
            $shippingAddress->setCustomerShippingEntity($this);
        }

        return $this;
    }

    public function removeShippingAddress(AddressEntity $shippingAddress): static
    {
        if ($this->shippingAddresses->removeElement($shippingAddress)) {
            // set the owning side to null (unless already changed)
            if ($shippingAddress->getCustomerShippingEntity() === $this) {
                $shippingAddress->setCustomerShippingEntity(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, AddressEntity>
     */
    public function getBillingAddresses(): Collection
    {
        return $this->billingAddresses;
    }

    public function addBillingAddress(AddressEntity $billingAddress): static
    {
        if (!$this->billingAddresses->contains($billingAddress)) {
            $this->billingAddresses->add($billingAddress);
            $billingAddress->setCustomerBillingEntity($this);
        }

        return $this;
    }

    public function removeBillingAddress(AddressEntity $billingAddress): static
    {
        if ($this->billingAddresses->removeElement($billingAddress)) {
            // set the owning side to null (unless already changed)
            if ($billingAddress->getCustomerBillingEntity() === $this) {
                $billingAddress->setCustomerBillingEntity(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, OrderEntity>
     */
    public function getOrderEntities(): Collection
    {
        return $this->orderEntities;
    }

    public function addOrderEntity(OrderEntity $orderEntity): static
    {
        if (!$this->orderEntities->contains($orderEntity)) {
            $this->orderEntities->add($orderEntity);
            $orderEntity->setCustomer($this);
        }

        return $this;
    }

    public function removeOrderEntity(OrderEntity $orderEntity): static
    {
        if ($this->orderEntities->removeElement($orderEntity)) {
            // set the owning side to null (unless already changed)
            if ($orderEntity->getCustomer() === $this) {
                $orderEntity->setCustomer(null);
            }
        }

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
}
