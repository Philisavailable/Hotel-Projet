<?php

namespace App\Form;


use App\Entity\Commande;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class CommandeFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateDebut',DateType::class,[
                'label'=>'date de début',
                'widget' => 'single_text'
            ])
            ->add('dateFin',DateType::class,[
                'label'=>'date de fin',
                'widget' => 'single_text'
            ])
            ->add('prenom',TextType::class,[
                'label'=>'Prénom'
            ])
            ->add('nom',TextType::class,[
                'label'=>'Nom'
            ])
            ->add('telephone',TextType::class,[
                'label'=>'Numero telephone',
            ])
            ->add('email',EmailType::class,[
                'label'=>'email',
                    
            ])
            ->add('submit', SubmitType::class, [
                'label' => "Valider",
                'validate' => false,
                'attr' => [
                    'class' => 'd-block mx-auto my-3 col-4 btn btn-warning'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commande::class,
        ]);
    }
}