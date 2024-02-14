<?php

namespace App\Form;

use App\Entity\Todo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class TodoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom*',
                'attr' => [
                'placeholder' => 'Indiquez votre nom...'
                ]
            ])

            ->add('details', TextareaType::class, [
                'label' => 'Détails*',
                'attr' => [
                    'cols' => 50,
                    'rows' => 10,
                    'placeholder' => 'Détaillez votre todo...',
                ]
            ])
            ->add('completed', ChoiceType::class, [
                'label' => 'La Todo est-elle complète ?*',
                'choices' => [
                    'Oui' => true,
                    'Non' => false,
                ],
                'expanded' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Todo::class,
        ]);
    }
}
