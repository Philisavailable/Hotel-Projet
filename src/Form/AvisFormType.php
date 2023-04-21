<?php

namespace App\Form;

use App\Entity\Avis;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AvisFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom',
                'constraints' => [
                    new NotBlank()
                ] 
            ])
            ->add('comment', TextareaType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Ecrivez votre avis...',
                    'class' => 'my-4',
                    'style' => 'height: 130px;'
                ],
                'constraints' => [
                    new NotBlank()
                ]           
            ])
            ->add('category', ChoiceType::class, [
                'label' => 'Catégorie',
                'choices' => [
                'Chambre' => 'chambre',
                'Restaurant' => 'restaurant',
                'Spa' => 'spa',
                'Sujet général' => 'sujet-general'
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Laissez votre avis',
                'attr' => [
                    'class' => 'my-5 d-block mx-auto btn-dark col-5'
                ],
                'validate' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Avis::class,
        ]);
    }
}
