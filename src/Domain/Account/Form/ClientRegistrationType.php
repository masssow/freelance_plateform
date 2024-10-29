<?php

namespace App\Domain\Account\Form;

use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class ClientRegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'constraints' => [
                    new Assert\NotBlank(message: 'L\'email ne peut pas être vide'),
                    new Email(message: 'Veuillez entrer un email valide'),
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Entrez votre email',
                ],
            ])
            ->add('nomEntreprise', TextType::class, [
                'label' => 'Nom de l\'entreprise',
                'constraints' => [
                    new Assert\NotBlank(message: 'Le nom de l\'entreprise ne peut pas être vide'),
                    new Assert\Length(
                        max: 50,
                        maxMessage: "Le nom ne doit pas dépasser {{ limit }} caractères."
                ),
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Entrez le nom de l\'entreprise',
                ],
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Mot de passe',
                'constraints' => [
                    new Assert\NotBlank(message: 'Le mot de passe ne peut pas être vide'),
                    new Assert\Length(
                        min: 6,
                        minMessage: 'Votre mot de passe doit comporter au moins {{ limit }} caractères',
                    ),
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Entrez un mot de passe',
                ],
            ])
            ->add('budgetTotal', MoneyType::class, [
                'label' => 'Budget total',
                'required' => false,
                'currency' => 'EUR',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'S\'inscrire',
                'attr' => [
                    'class' => 'btn btn-primary',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
