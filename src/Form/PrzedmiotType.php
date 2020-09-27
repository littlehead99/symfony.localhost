<?php

namespace App\Form;

use App\Entity\Przedmiot;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PrzedmiotType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nazwa',TextType::class)
            ->add('prowadzacy',TextType::class)
            ->add('kierunek')
            ->add('Zapisz',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Przedmiot::class,
        ]);
    }
}
