<?php

namespace App\Form;

use App\Entity\CustomerEntity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Du musst unseren Bedingungen zustimmen.',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Bitte gebe ein Passwort ein',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Dein Passwort sollte mindestens {{ limit }} Zeichen haben',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            // note: limits could be defined
            // note: country / salutation missing
            ->add('firstName')
            ->add('lastName')
            ->add('zipCode', TextType::class,
                array(
                    'data_class' => null,
                    'mapped' => false,
                ))
            ->add('city', TextType::class,
                array(
                    'data_class' => null,
                    'mapped' => false,
                ))
            ->add('street', TextType::class,
                array(
                    'data_class' => null,
                    'mapped' => false,
                ))
            ->add('phoneNumber', TextType::class,
                array(
                    'data_class' => null,
                    'mapped' => false,
                ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CustomerEntity::class,
        ]);
    }
}
