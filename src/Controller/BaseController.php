<?php

namespace App\Controller;

use App\Entity\ProductEntity;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BaseController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        // note: get productRepository and find all products (should be paginated)
        $products = $entityManager->getRepository(ProductEntity::class)->findAll();

        // note: return homepage index.html with found productEntities
        return $this->render('homepage.html.twig', ['products' => $products]);
    }
}
