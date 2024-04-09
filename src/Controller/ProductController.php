<?php

namespace App\Controller;

use App\Entity\ProductEntity;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProductController extends AbstractController
{
    #[Route('/product/{id}', name: 'product_detail', methods: ['GET'])]
    public function productDetail(string $id, EntityManagerInterface $entityManager): Response
    {
        // note: get productRepository and find product by given id
        $product = $entityManager->getRepository(ProductEntity::class)->find($id);

        // note: return product index.html with found productEntity
        return $this->render('product/index.html.twig', [
            'product' => $product,
        ]);
    }
}
