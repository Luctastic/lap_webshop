<?php

namespace App\Entity;

use App\Defaults;
use App\Repository\ProductEntityRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;

#[ORM\Entity(repositoryClass: ProductEntityRepository::class)]
class ProductEntity
{
    #[ORM\Id]
    #[ORM\Column]
    #[ORM\GeneratedValue]
    private ?int $id = null;

    // note: versionId as primary would be so that old orders won't update if products get updated
//    #[ORM\Id]
//    #[ORM\Column]
//    private string $versionId = Defaults::DEFAULT_VERSION_ID;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 32)]
    private ?string $productNumber = null;

    #[ORM\Column(length: 128, nullable: true)]
    private ?string $picturePath = null;

    // note: better picture saving strategy
//    #[ORM\Column(nullable: true)]
//    private ?File $picture = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    // note: versionId as primary would be so that old orders won't update if products get updated
//    public function getVersionId(): string
//    {
//        return $this->versionId;
//    }
//
//    public function setVersionId(string $versionId): static
//    {
//        $this->versionId = $versionId;
//
//        return $this;
//    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
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

    public function getProductNumber(): ?string
    {
        return $this->productNumber;
    }

    public function setProductNumber(string $productNumber): static
    {
        $this->productNumber = $productNumber;

        return $this;
    }

    public function getPicturePath(): ?string
    {
        return $this->picturePath;
    }

    public function setPicturePath(?string $picturePath): static
    {
        $this->picturePath = $picturePath;

        return $this;
    }

    // note: better picture saving strategy
//    public function getPicture(): ?File
//    {
//        return $this->picture;
//    }
//
//    public function setPicture(?File $picture): static
//    {
//        $this->picture = $picture;
//
//        return $this;
//    }
}
