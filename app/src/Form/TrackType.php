<?php

namespace App\Form;

use App\DTO\TrackDto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TrackType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $progetto = [
            'Progetto 1' => 'progetto 1',
            'Progetto 2' => 'progetto 2',
            'Progetto 3' => 'progetto 3',
        ];

        $builder
            ->add('progetto', ChoiceType::class, ['choices' => $progetto])
            ->add('data', DateType::class, ['widget' => 'single_text'])
            ->add('ore', TextType::class)
            ->add('save', SubmitType::class)
        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TrackDto::class
        ]);
    }
}
