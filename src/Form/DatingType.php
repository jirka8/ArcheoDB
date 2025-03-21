<?php

namespace App\Form;

use App\Entity\Datings;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DatingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('parent', EntityType::class, [
                'class' => Datings::class,
                'choice_label' => 'title',
                'required' => false,
                'placeholder' => 'Nemá nadřazenou kategorii',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Datings::class,
        ]);
    }
}
