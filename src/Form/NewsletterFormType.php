<?php

namespace App\Form;

use App\Entity\Newsletter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class NewsletterFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Prenom', TextType::class, [
                'label' => 'Prénom',
                'constraints' => [
                    new NotBlank(),
                    new Length([
                        'min' => 1,
                        'max' => 80
                    ])
                ]
            ])
            ->add('Nom', TextType::class, [
                'label' => 'Nom',
                'constraints' => [
                    new NotBlank(),
                    new Length([
                        'min' => 1,
                        'max' => 100
                    ])
                ]
            ])
            ->add('Email', EmailType::class, [
                'label' => 'Choisissez un email',
                'constraints' => [
                    new NotBlank(),
                    new Length([
                        'min' => 4,
                        'max' => 255
                    ])
                ]
            ])
            ->add('subbmit', SubmitType::class, [
                'label' => "Je m'inscris",
                'validate' => false,
                'attr' => [
                    'class' => 'd-block mx-auto my-3 col-4 btn btn-primary'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Newsletter::class,
        ]);
    }
}
