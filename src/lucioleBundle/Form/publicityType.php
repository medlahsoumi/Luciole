<?php

namespace lucioleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class publicityType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('iD')->add('titre')
            ->add('description')
            ->add('video', FileType::class,[
                'label'=>'video',
                'mapped'=>false,
            ])
            ->add('zone')
            ->add('dateDebut')
            ->add('dateFin');
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'lucioleBundle\Entity\publicity'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'luciolebundle_publicity';
    }


}
