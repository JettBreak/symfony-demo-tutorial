<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ContactForm extends AbstractType
{
    #[\Override]
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('id', HiddenType::class)
        ->add('name', TextType::class, [
            'label' => 'Name',
            'required' => false,
            'constraints' => [
                new NotBlank(
                    message: 'Name is required.'
                ),
                new Length(
                    max: 200,
                    maxMessage: 'Name cannot be longer than {{ limit }} characters',
                ),
            ],
        ]);
    }
}
