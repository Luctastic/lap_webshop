<?php

namespace App\Controller;

use App\Entity\AddressEntity;
use App\Entity\BasketEntity;
use App\Entity\CountryEntity;
use App\Entity\CustomerEntity;
use App\Entity\SalutationEntity;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class CustomerController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, Security $security, EntityManagerInterface $entityManager): Response
    {
        $user = new CustomerEntity();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $firstName = $form->get('firstName')->getData();
            $lastName = $form->get('lastName')->getData();

            // todo: currently setting salutation hardcoded to "Herr" and country to "AUT"
            $salutation = $entityManager->getRepository(SalutationEntity::class)->findbySalutation('Herr');
            $country = $entityManager->getRepository(CountryEntity::class)->findByInitials('AUT');

            $user->setSalutation($salutation);

            // note: creating new customer address
            $address = new AddressEntity();
            $address->setSalutation($salutation);
            $address->setFirstName($firstName);
            $address->setLastName($lastName);
            $address->setCity($form->get('city')->getData());
            $address->setCountry($country);
            $address->setPhoneNumber($form->get('phoneNumber')->getData());
            $address->setStreet($form->get('street')->getData());

            $entityManager->persist($address);
            $entityManager->flush();

            // note: assign empty basket on registration
            $user->setBasket(new BasketEntity());

            // todo: currently same addresses for billing / shipping
            $user->addBillingAddress($address);
            $user->addShippingAddress($address);

            $entityManager->persist($user);
            $entityManager->flush();

            return $security->login($user, 'form_login', 'main');
        }

        return $this->render('customer/register.html.twig', [
            'registrationForm' => $form,
        ]);
    }

    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('customer/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
