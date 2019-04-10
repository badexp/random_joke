<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

class RandomJokeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'E-mail: ',
                'constraints' => [
                    new NotBlank(),
                    new Email()
                ]
            ])
            ->add('category', ChoiceType::class, [
                'label' => 'Category: ',
                'choices'  => $options['categories'],
                'constraints' => [
                    new NotBlank(),
                    new Choice(['choices'  => $options['categories']])
                ]
            ])
            ->add('send', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setRequired([
            'categories'
        ]);
    }
}
