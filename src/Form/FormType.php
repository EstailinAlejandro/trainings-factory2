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

class FormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('firstname')
            ->add('preprovision')
            ->add('lastname')
            ->add('dateofbirth', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date of Birth',
                'attr' => [
                    'class' => 'datepicker', // Optional CSS class for styling
                ],
            ])// ->add('agreeTerms', CheckboxType::class, [
// 'mapped' => false,
// 'constraints' => [
// new IsTrue([
// 'message' => 'You should agree to our terms.',
// ]),
// ],
// ])
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
            ->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event) use ($options) {
                /** @var Person $user */
                $user = $event->getData();
                $user->setRoles(["ROLE_MEMBER"]);
            })
            ->add('Save', SubmitType::class)
        ;
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Person::class,
        ]);
    }
}
