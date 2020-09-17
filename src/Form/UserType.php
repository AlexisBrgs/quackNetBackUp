<?php

namespace App\Form;

use App\Entity\User;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, [
                'label' => 'What is your firstname ?',
                'attr' => ['class' =>'form-control my-2', 'rows' => 3,]
            ])
            ->add('lastName', TextType::class, [
                'label' => 'What is your lastname ?',
                'attr' => ['class' =>'form-control my-2', 'rows' => 3]
            ])
            ->add('duckName', TextType::class, [
                'label' => 'What is your duckname ?',
                'attr' => ['class' =>'form-control my-2', 'rows' => 3]
            ])
            ->add('email', EmailType::class, [
                'attr' => ['class' =>'form-control my-2', 'rows' => 3]
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'The password fields must match.',
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => true,
                'first_options'  => [
                    'label' => 'Password',
                    'attr' =>  ['class' =>'form-control my-2', 'rows' => 3]],
                'second_options' => [
                    'label' => 'Repeat Password',
                    'attr' => ['class' =>'form-control my-2', 'rows' => 3]],
            ])
            ->add('img', UrlType::class, [
                'label' => 'Choose a duckyful profile picture ( png, jpg or gif please ) ',
                'attr' => ['class' =>'form-control my-2', 'rows' => 3],
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
