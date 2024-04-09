<?php

namespace App\Controller;

use App\Entity\BasketEntryEntity;
use App\Entity\CustomerEntity;
use App\Entity\ProductEntity;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BasketController extends AbstractController
{
    /**
     * @param Security $security
     */
    public function __construct(private Security $security,){
    }

    #[Route('/basket', name: 'basket')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        // note: get current user
        $user = $this->security->getUser();

        if(!$user){
            return $this->render('basket/index.html.twig');
        }

        $customer = $entityManager->getRepository(CustomerEntity::class)->findByEmail($user->getUserIdentifier());

        return $this->render('basket/index.html.twig', [
            'basket' => $customer->getBasket(),
        ]);
    }

    #[Route('/add-to-basket', name: 'add_to_basket',methods: ['POST'])]
    public function addToBasket(Request $request, EntityManagerInterface $entityManager): Response
    {
        // note: get current user
        $user = $this->security->getUser();

        // note: fetch customer by mail
        /** @var CustomerEntity $customer */
        $customer = $entityManager->getRepository(CustomerEntity::class)->findByEmail($user->getUserIdentifier());
        $product = $entityManager->getRepository(ProductEntity::class)->find($request->request->get('productId'));

        $basket = $customer->getBasket();

        $basketEntry = new BasketEntryEntity();

        // todo: add support for multiple entries of the same product
        $basketEntry->setQuantity(1);
        $basketEntry->setProduct($product);

        $basket->addBasketEntry($basketEntry);

        $entityManager->persist($basketEntry);
        $entityManager->flush();
        $entityManager->persist($user);
        $entityManager->flush();

        return $this->render('basket/index.html.twig', [
            'basket' => $basket,
        ]);
    }
}
