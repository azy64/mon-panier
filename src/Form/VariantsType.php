<?php

namespace App\Form;

use App\Entity\Variants;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VariantsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('codeCouleur')
            ->add('libeleCouleur')
            ->add('prix')
            ->add('photo')
            ->add('taille')
            ->add('produit')
            ->add('stock')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Variants::class,
        ]);
    }
}
