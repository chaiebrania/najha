<?php

namespace App\Form;

use App\Entity\Marque;
use App\Entity\PosteTravail;
use App\Entity\GeneralInstrument;
use App\Entity\SpecificInstrument;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SpecificInstrumentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('GeneralInstrument',EntityType::class,[
            'label'=>'Code',
            'class'=>GeneralInstrument::class,
            'choice_label'=>'code',
            'placeholder'=>'--choisir--'
        ])
        ->add('poste',EntityType::class,[
            'label'=>'poste',
            'class'=>PosteTravail::class,
            'choice_label'=>'nom',
            'placeholder'=>'--choisir--'
        ])

       
        ->add('Marque',EntityType::class,[
            'label'=>'marque',
            'class'=>Marque::class,
            'choice_label'=>'nom',
            'placeholder'=>'--choisir--'
        ])
            ->add('minEtendu', null, [
                'label' => 'Etendu min'
            ])
            ->add('maxEtendu', null, [
                'label' => 'Etendu max'
            ])
          
            ->add('unit', null, [
                'label' => 'Unité'
            ])
            ->add('precisionn', null, [
                'label' => 'Précision'
            ])
            ->add('frequenceCalibrage', null, [
                'label' => 'Fréquence calibrage'
            ])
            ->add('resolution', null, [
                'label' => 'Résolution'
            ])
            ->add('type', null, [
                'label' => 'Type'
            ])
            ->add('dateMiseEnService', null, [
                'label' => 'Date de mise en service'
            ])
            ->add('serialNumber', null, [
                'label' => 'Numéro de série'
            ])
            ->add('frequenceEtallonage', null, [
                'label' => 'Fréquence d\'étallonage'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SpecificInstrument::class,
        ]);
    }
}
