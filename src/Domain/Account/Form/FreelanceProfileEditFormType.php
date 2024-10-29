<?php

namespace App\Domain\Account\Form;

use App\Entity\Dashboard;
use App\Entity\Freelance;
use App\Entity\Projet;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FreelanceProfileEditFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('roles')
            ->add('password')
            ->add('cv')
            ->add('portfolio')
            ->add('competences')
            ->add('experiences')
            ->add('dashboard', EntityType::class, [
                'class' => Dashboard::class,
'choice_label' => 'id',
            ])
            ->add('projets', EntityType::class, [
                'class' => Projet::class,
'choice_label' => 'id',
'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Freelance::class,
        ]);
    }
}
