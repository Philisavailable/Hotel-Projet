<?php

namespace App\Form;

use App\Entity\Chambre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ChambreFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class,  [
                'label' => 'Titre',
                'constraints' => [
                    new NotBlank(),
                    new Length([
                        'min' => 4,
                        'max' => 20
                    ])
                ]
            ])
            ->add('descriptionCourte', TextType::class,  [
                'label' => 'Description (courte)',
                'constraints' => [
                    new NotBlank(),
                    new Length([
                        'min' => 3,
                        'max' => 110
                    ])
                ]
            ])
            ->add('descriptionLongue', TextareaType::class, [
                'label' => 'Description (longue)',
                'constraints' => [
                    new NotBlank(),
                    new Length([
                        'min' => 3
                    ])
                ]
            ])
            ->add('photo', FileType::class, [
                'label' => 'Photo',
                'data_class' => null,
                'mapped' => false,
                'attr' => [
                    'value' => $options['photo'] !== null ? $options['photo'] : ''
                ],
                'constraints' => [
                    new Image([
                        'mimeTypes' => ['image/jpeg', 'image/png'],
                    ])
                ]
            ])
            ->add('prixJournalier', TextType::class, [
                'label' => 'Prix',
                'constraints' => [
                    new NotBlank(),
                    new Length([
                        'min' => 3,
                        'max' => 6
                    ])
                ]

            ])
            ->add('submit', SubmitType::class, [
                'label' => $options['photo'] === null ? 'Créer' : 'Modifier',
                'validate' => false,
                'attr' => [
                    'class' => "d-block mx-auto my-3 btn btn-primary col-3"
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Chambre::class,
            'allow_file_upload' => true,
            'photo' => null,
        ]);
    }
}
