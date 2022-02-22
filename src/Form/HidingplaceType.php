<?php

namespace App\Form;

use App\Entity\HidingPlaces;
use App\Entity\Countries;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HidingplaceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type',TextType::class,[
                'label' => 'Type',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Entrez le type'
                ]
            ])

            ->add('address',TextType::class,[
                'label' => 'Adresse',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Entrez une adresse'
                ]
            ])

             ->add('alias', TextType::class,[
                'label' => 'Nom de Code',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Entrez un nom de code'
                ]
            ])

            ->add('country', EntityType::class, [
                'required' => true,
                'class' => Countries::class,
                'label' => 'Pays'
            ]);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => HidingPlaces::class,
        ]);
    }
}
