<?php

namespace lucioleBundle\Form;
use lucioleBundle\Entity\user;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class userType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder            ->add('email', EmailType::class,array(
            'label'  => 'Email',
            'attr'   =>  array(
                'class'   => 'form-control')
        ))
            ->add('username', TextType::class,array(
                'label'  => 'username',
                'attr'   =>  array(
                    'class'   => 'form-control'
                   )
            ))
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options'  => ['label' => 'Password'],
                'second_options' => ['label' => 'Repeat Password'],
            ])
            ->add('cIN', null,array(
            'label'  => 'CIN',
            'attr'   =>  array(
                'class'   => 'form-control')
        ))
            ->add('nom', null,array(
        'label'  => 'nom',
        'attr'   =>  array(
            'class'   => 'form-control')
    ))
            ->add('prenom', null,array(
                'label'  => 'Prenom',
                'attr'   =>  array(
                    'class'   => 'form-control')
            ))
            ->add('typeVoiture', null,array(
                'label'  => 'type de Voiture',
                'attr'   =>  array(
                    'class'   => 'form-control')
            ))
            ->add('matricule', null,array(
                'label'  => 'Matricule',
                'attr'   =>  array(
                    'class'   => 'form-control')
            ))
            ->add('telephone', null,array(
                'label'  => 'Telephone',
                'attr'   =>  array(
                    'class'   => 'form-control')
            ))
            ->add('Create', SubmitType::class, [
                'attr' => ['class' => 'btn btn-orange btn-icon left-icon mr-10 pull-left'],
            ]);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'lucioleBundle\Entity\user'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'luciolebundle_user';
    }


}
