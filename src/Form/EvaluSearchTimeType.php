<?php

namespace App\Form;

use App\Entity\EvaluSearchTime;
use DateTimeImmutable;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Customer;
use App\Entity\Project;
use App\Entity\Tasks;
use App\Entity\User;

class EvaluSearchTimeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('project', EntityType::class,['class'=>Project::class,
                'choice_label' => 'projectName',
                'label' => 'projekte',
                'placeholder' => 'projekte',


            ])
            ->add('customer', EntityType::class,['class'=>Customer::class,
                'choice_label' => 'name',
                'label' => 'Kunden',
                'placeholder' => 'Kunden',

            ])
            ->add('tasks', EntityType::class,['class'=>Tasks::class,
                'choice_label' => 'name',
                'label' => 'Aufgaben',
                'placeholder' => 'wahlen'
            ]);


            /*->add('createdAt',DateTimeType::class, [
                'widget' => 'single_text',
             'input' => 'datetime_immutable',
                'html5'=> true
            ]);*/
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => EvaluSearchTime::class,
            'method' => 'GET',
            'csrf_protection' => false
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
