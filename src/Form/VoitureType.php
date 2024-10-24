<?php

namespace App\Form;

use App\Entity\Voiture;
use App\Entity\Usine;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VoitureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom',
            ])
            ->add('fabrication', DateType::class, [
                'label' => 'Date de Fabrication',
                'widget' => 'single_text', // Use a single text input for the date
            ])
            ->add('prix', IntegerType::class, [
                'label' => 'Prix',
            ])
            ->add('usine', EntityType::class, [
                'class' => Usine::class,
                'choice_label' => 'nom', // Display the 'nom' property of Usine
                'label' => 'Usine',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Voiture::class,
        ]);
    }
}
