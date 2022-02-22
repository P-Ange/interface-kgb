<?php

namespace App\Form;

use App\Entity\Targets;
use App\Entity\Countries;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TargetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname',TextType::class,[
                'label' => 'Prénom',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Entrez le prénom'
                ]
            ])

            ->add('lastname',TextType::class,[
                'label' => 'Nom',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Entrez le nom'
                ]
            ])

            ->add('alias', TextType::class,[
                'label' => 'Nom de Code',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Entrez un nom de code'
                ]
            ])

            ->add('date_of_birth', DateType::class, [
                'required' => true,
                'label' => 'Date de naissance',
                'widget' => 'choice',
                'format' => 'd M y',
                'years' => range(date('Y')-80, date('Y')-18)
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
            'data_class' => Targets::class,
        ]);
    }
}
