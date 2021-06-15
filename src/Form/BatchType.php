<?php

namespace App\Form;

use App\Entity\Batch;
use App\Entity\Name;
use App\Entity\Fridge;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class BatchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('size',IntegerType::class,[
                'label' => 'Размер'
            ])
            ->add('date',DateType::class,[
                'label' => 'Дата разлива'
            ])
            ->add('name',EntityType::class,[
                'class' => Name::class,
                'label' => 'Вино'
            ])
            ->add('fridge',EntityType::class,[
                'class' => Fridge::class,
                'label' => 'Холодильная камера'
            ])       
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Batch::class,
        ]);
    }
}
