<?php

namespace App\Entity;

use App\Repository\AddressEntityRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AddressEntityRepository::class)]
class AddressEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $firstName = null;

    #[ORM\Column(length: 50)]
    private ?string $lastName = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $zipCode = null;

    #[ORM\Column(length: 50)]
    private ?string $city = null;

    #[ORM\Column(length: 255)]
    private ?string $street = null;

    #[ORM\Column(length: 255)]
    private ?string $phoneNumber = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $additionalAddressLine = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?SalutationEntity $salutation = null;

    #[ORM\ManyToOne(inversedBy: 'shippingAddresses')]
    private ?CustomerEntity $customerShippingEntity = null;

    #[ORM\ManyToOne(inversedBy: 'billingAddresses')]
    private ?CustomerEntity $customerBillingEntity = null;

    #[ORM\ManyToOne(inversedBy: 'addressEntities')]
    #[ORM\JoinColumn(nullable: false)]
    private ?CountryEntity $country = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    public function setZipCode(?string $zipCode): static
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(string $street): static
    {
        $this->street = $street;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): static
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getAdditionalAddressLine(): ?string
    {
        return $this->additionalAddressLine;
    }

    public function setAdditionalAddressLine(?string $additionalAddressLine): static
    {
        $this->additionalAddressLine = $additionalAddressLine;

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

    public function getCustomerShippingEntity(): ?CustomerEntity
    {
        return $this->customerShippingEntity;
    }

    public function setCustomerShippingEntity(?CustomerEntity $customerShippingEntity): static
    {
        $this->customerShippingEntity = $customerShippingEntity;

        return $this;
    }

    public function getCustomerBillingEntity(): ?CustomerEntity
    {
        return $this->customerBillingEntity;
    }

    public function setCustomerBillingEntity(?CustomerEntity $customerBillingEntity): static
    {
        $this->customerBillingEntity = $customerBillingEntity;

        return $this;
    }

    public function getCountry(): ?CountryEntity
    {
        return $this->country;
    }

    public function setCountry(?CountryEntity $country): static
    {
        $this->country = $country;

        return $this;
    }
}
