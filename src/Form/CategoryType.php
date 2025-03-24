<?php

namespace App\Form;

use App\Entity\Categories;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        // get data
        $data = $builder->getData();

        // title
        $builder->add('title');

        // edit or add (if edit we must remove current category from the list)
        if ($data->getId() !== null) {
            $builder
                ->add('parent', EntityType::class, [
                    'class' => Categories::class,
                    'choice_label' => 'title',
                    'required' => false,
                    'placeholder' => 'Nemá nadřazenou kategorii',
                    'query_builder' => function (EntityRepository $er) use ($data) {
                        return $er->createQueryBuilder('c')
                            ->where('c.id != :id')
                            ->setParameter('id', $data->getId());
                    },
                ])
            ;
        } else {
            $builder
                ->add('parent', EntityType::class, [
                    'class' => Categories::class,
                    'choice_label' => 'title',
                    'required' => false,
                    'placeholder' => 'Nemá nadřazenou kategorii',
                ])
            ;
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Categories::class,
        ]);
    }
}
