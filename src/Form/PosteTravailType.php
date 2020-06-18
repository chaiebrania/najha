<?php

namespace App\Form;

use App\Entity\Section;
use App\Entity\PosteTravail;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PosteTravailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('Section',EntityType::class,[
                'label'=>'section',
                'class'=>Section::class,
                'choice_label'=>'nom',
                'placeholder'=>'--choisir--'
            ])
        ;
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PosteTravail::class,
        ]);
    }
}
