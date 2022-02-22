<?php

namespace App\Form;

use App\Entity\Agents;
use App\Entity\Contacts;
use App\Entity\Countries;
use App\Entity\HidingPlaces;
use App\Entity\Missions;
use App\Entity\MissionTypes;
use App\Entity\Skills;
use App\Entity\StatusMissions;
use App\Entity\Targets;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MissionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title',TextType::class,[
                'label' => 'Titre',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Entrez titre de la mission'
                ]
            ])

            ->add('description', TextareaType::class,[
                'label' => 'Description',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Entrez une description'
                ]
            ])

            ->add('codename', TextType::class,[
                'label' => 'Nom de Code',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Entrez un nom de code'
                ]
            ])

            ->add('start_date', DateType::class, [
                'required' => true,
                'label' => 'Date de début',
                'widget' => 'choice',
                'format' => 'd M y',
                'years' => range(date('Y'), 2030)
            ])

            ->add('end_date', DateType::class, [
                'required' => true,
                'label' => 'Date de fin',
                'widget' => 'choice',
                'format' => 'd M y',
                'years' => range(date('Y'), 2030)
            ])

            ->add('skill', EntityType::class, [
                'required' => true,
                'class' => Skills::class,
                'label' => 'Compétence'
            ])

            ->add('mission_type', EntityType::class, [
                'required' => true,
                'class' => MissionTypes::class,
                'label' => 'Type de mission'
            ])

            ->add('status_mission', EntityType::class, [
                'required' => true,
                'class' => StatusMissions::class,
                'label' => 'Statut'
            ])

            ->add('country', EntityType::class, [
                'required' => true,
                'class' => Countries::class,
                'label' => 'Pays'
            ])

            ->add('agents', EntityType::class, array(
                'label' => 'Agent(s)',
                'class' => Agents::class,
                'choice_label' => function ($agents) {
                    return $agents->getIdCode()." (". $agents->getCountry()." | Compétence(s)". implode(",",$agents->displaySkills()).") ";
                },
                'multiple' => true,
                'expanded' => true,
                'required' => true
            ))

            ->add('targets', EntityType::class, array(
                'label' => 'Cible(s)',
                'class' => Targets::class,
                'choice_label' => function ($targets) {
                    return $targets->getAlias()." (". $targets->getCountry().")";
                },
                'multiple' => true,
                'expanded' => true,
                'required' => true
            ))

            ->add('contacts', EntityType::class, array(
                'label' => 'Contact(s)',
                'class' => Contacts::class,
                'choice_label' => function ($contacts) {
                    return $contacts->getCodeName()." (". $contacts->getCountry().")";
                },
                'multiple' => true,
                'expanded' => true,
                'required' => true
            ))

            ->add('hidingplaces', EntityType::class, array(
                'label' => 'Refuge(s)',
                'class' => HidingPlaces::class,
                'choice_label' => function ($hidingplaces) {
                    return $hidingplaces->getAlias()." (". $hidingplaces->getCountry().")";
                },
                'multiple' => true,
                'expanded' => true,
                'required' => true
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Missions::class,
        ]);
    }
}
