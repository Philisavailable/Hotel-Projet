<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HotelContactFromType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom'
            ])
            ->add('prenom', TextType::class, [
                'label' => 'Prénom'
                
            ])
            ->add('email', TextType::class, [
                'label' => 'Email'
                
                ])
            ->add('sujet', TextType::class, [
                'label' => 'Sujet'
                
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
            ->add('message', TextareaType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Ecrivez votre message...',
                    'class' => 'my-4',
                    'style' => 'height: 130px;'
                ]                
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Envoyer votre message',
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
            'data_class' => Contact::class,
        ]);
    }
}
