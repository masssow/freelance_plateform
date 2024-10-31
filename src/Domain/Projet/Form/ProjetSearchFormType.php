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
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class ProjetSearchFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, [
                'required' => false,
                'label' => 'Titre du projet',
                'attr' => ['placeholder' => 'Recherche par titre'],
            ])
            ->add('competencesRequises', TextType::class, [
                'required' => false,
                'label' => 'Compétences requises',
                'attr' => ['placeholder' => 'Recherche par compétences'],
            ])
            ->add('budgetMax', NumberType::class, [
                'required' => false,
                'label' => 'Budget maximum',
                'attr' => ['placeholder' => 'Budget maximum'],
            ])
            ->add('nomEntreprise', TextType::class, [
                'required' => false,
                'label' => 'Nom de l\'entreprise',
                'attr' => ['placeholder' => 'Recherche par nom d\'entreprise'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Projet::class,
        ]);
    }
}
