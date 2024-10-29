<?php

namespace App\Domain\Projet\Form;

use App\Entity\Client;
use App\Entity\Projet;
use App\Entity\Freelance;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class ProjetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, [
                'label' => 'Titre du projet'
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description'
            ])
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'Créé' => Projet::STATUS_CREATED,
                    'En cours' => Projet::STATUS_IN_PROGRESS,
                    'Terminé' => Projet::STATUS_COMPLETED,
                    'Annulé' => Projet::STATUS_CANCELLED
                ],
                'label' => 'Statut',
            ])
            ->add('competencesRequises', CollectionType::class, [
                'entry_type' => TextType::class,
                'entry_options' => [
                    // 'label' => true,
                    'attr' => [
                        'placeholder' => 'Saisissez une compétence',
                        'class' => 'form-control competence-field',
                    ]
                ],
                'allow_add' => true,
                'allow_delete' => true,
                'label' => 'Compétences requises',
                'by_reference' => false,
                'prototype' => true,
                'prototype_name' => '__name__', // Nom de prototype standard pour un fonctionnement stable
                'attr' => [
                    'class' => 'competences-collection',
                ],
            ])
            ->add('budget')
            ->add('datePublication', null, [
                'widget' => 'single_text',
            ])
            ->add('dateLimiteCandidature', null, [
                'widget' => 'single_text',
            ])
            ->remove('freelances', EntityType::class, [
                'class' => Freelance::class,
                    'choice_label' => 'id',
                    'multiple' => true,
            ])
            ->remove('clientCreateur', EntityType::class, [
                'class' => Client::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Projet::class,
        ]);
    }
}
