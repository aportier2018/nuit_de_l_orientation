<?php

namespace App\Form;

use App\Entity\Motcle;
use App\Entity\Exponent;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExponentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nameexp')
            ->add('activity')
            ->add('motcle', EntityType::class,[
                'class'=> Motcle::class,
                'choice_label' => 'namemc',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Exponent::class,
        ]);
    }
}
