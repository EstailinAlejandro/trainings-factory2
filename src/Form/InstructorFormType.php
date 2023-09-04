<?php

namespace App\Form;

use App\Entity\Person;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class InstructorFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('plainPassword', PasswordType::class, [
// instead of being set onto the object directly,
// this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 3,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
// max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('firstname')
            ->add('lastname')
            ->add('preprovision')
            ->add('dateofbirth', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date of Birth',
                'attr' => [
                    'class' => 'datepicker', // Optional CSS class for styling
                ],
            ])
            ->add('hiring_date', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Hiring Date',
                'attr' => [
                    'class' => 'datepicker', // Optional CSS class for styling
                ],
            ])
            ->add('salary')
            ->add('social_sec_number')
            ->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event) use ($options) {
                /** @var Person $user */
                $user = $event->getData();
                $user->setRoles(["ROLE_INSTRUCTOR"]);
            })
            ->add('Save',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Person::class,
        ]);
    }
}
