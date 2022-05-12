<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;


/**
 *
 */
class EditUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EntityType::class,[
                'constraints' =>[
                    new NotBlank([
                        'message'=> 'mercie de saisir une adrese email'

                    ])
                ],
                'required'=> true,
                'attr' =>[
                    'class' => 'form_controle'
                ]
            ])
            ->add('roles', ChoiceType::class,[
                'choices' =>[
                    'utilisateur' => 'ROLE_USER',
                    'administrateur' => 'ROLE_ADMIN'
                ],
                'expanded'=> true,
                'multiple'=> true,
                'label'=> 'Roles'
            ])
            ->add('submit', SubmitType::class)
            ->add('role',ChoiceType::class,[
                'choices' =>[
                    'utilisateur' => 'ROLE_USER',
                    'administrateur' => 'ROLE_ADMIN'
                ],
                'expanded'=> true,
                'multiple'=> true,
                'label'=> 'Roles'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
