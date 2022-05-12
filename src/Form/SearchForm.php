<?php

namespace App\Form;

use App\Data\SearchData;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\FormTypeInterface;
use App\Entity\Customer;
use App\Entity\Project;
use App\Entity\Tasks;
use App\Entity\User;



class SearchForm extends AbstractType

{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('q', TextType::class,[
                'label' => false,
                'required'=> false,
                'attr'=> [
                    'placeholder' => 'Suchen'
                ]

            ])
            ->add('project', EntityType::class,[
                'class'=>Project::class,
                'choice_label' => 'projectName',
                'required' => false,
                'label' => 'projekte',
                'placeholder' => 'projekte',


            ])

            ->add('tasks', EntityType::class,['class'=>Tasks::class,
                'choice_label' => 'name',
                'label' => 'Aufgaben',
                'required' => false,
                'placeholder' => 'select'
            ])

            ->add('user', EntityType::class,['class'=>User::class,
                'choice_label' => 'nachname',
                'label' => 'Mitarbeiter',
                'required' => false,
                'placeholder' => 'Mitarbeiter',
            ])

            ->add('minDate',DateType::class, [
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'format' => 'yyyy-MM-dd',
            ])
            ->add('maxDate',DateType::class, [
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'format' => 'yyyy-MM-dd',
            ])








         /*   ->add('minDate',DateTimeType::class, [
                'widget' => 'single_text',
                'html5' => false,
            ])
            ->add('maxDate',DateTimeType::class, [
                // this is actually the default format for single_text
                'widget' => 'single_text',
                'placeholder' => 'Select a value',
                'html5'=> false,

            ])*/
        ;
    }


    public function configureOptions(OptionsResolver $resolver)
    {
       $resolver->setDefaults([
           'data_class'=> SearchData::class,
            'method' => 'GET',
           'csrf_protection' => false
       ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }




}