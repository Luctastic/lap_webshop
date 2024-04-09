<?php

namespace App\Command;

use App\Entity\ProductEntity;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

#[AsCommand(name: 'app:import-product')]
class ImportProductCommand extends Command
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setHelp('This command allows you to create multiple products...');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $products = $this->entityManager->getRepository(ProductEntity::class);

        $productId = $this->createProduct(9.99, 'Test Product 1', 'ABC1', '/product_import/mainboard.jpg');
        $output->writeln('Created new product with id: ' . $productId);

        $productId = $this->createProduct(19.99, 'Test Product 2', 'ABC12', '/product_import/mainboard2.jpg');
        $output->writeln('Created new product with id: ' . $productId);

        $productId = $this->createProduct(29.99, 'Test Product 3', 'ABC123', null);
        $output->writeln('Created new product with id: ' . $productId);

        $productId = $this->createProduct(39.99, 'Test Product 4', 'ABC1234', '/product_import/mainboard2.jpg');
        $output->writeln('Created new product with id: ' . $productId);

        return Command::SUCCESS;
    }

    private function createProduct(float $price, string $name, string $productNumber, ?string $picturePath): ?int
    {
        $product = new ProductEntity();

        $product->setPrice($price);
        $product->setName($name);
        $product->setProductNumber($productNumber);
        $product->setPicturePath($picturePath);

        $this->entityManager->persist($product);
        $this->entityManager->flush();

        return $product->getId();
    }
}
