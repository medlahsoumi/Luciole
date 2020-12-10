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
        $builder->add('iD', null,array(
            'label'  => 'identifiant',
            'attr'   =>  array(
                'class'   => 'form-control')
        ))
            ->add('titre', null,array(
                'label'  => 'titre',
                'attr'   =>  array(
                    'class'   => 'form-control')
            ))
            ->add('description', null,array(
        'label'  => 'Description',
        'attr'   =>  array(
            'class'   => 'form-control')
    ))
            ->add('video', FileType::class,[
                'label'=>'video',
                'mapped'=>false,
            ])
            ->add('zone', null,array(
                'label'  => 'Zone',
                'attr'   =>  array(
                    'class'   => 'form-control')
            ))
            ->add('dateDebut', null,array(
        'label'  => 'Date Debut',
        'attr'   =>  array(
            'class'   => 'form-control')
    ))
            ->add('dateFin', null,array(
                'label'  => 'Date Fin',
                'attr'   =>  array(
                    'class'   => 'form-control')
            ));
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
