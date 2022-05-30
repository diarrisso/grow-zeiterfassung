<?php

namespace App\Form;

use App\Entity\Tracking;
use App\Entity\User;
use App\Entity\Project;
use App\Entity\Tasks;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TrackingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('start', TimeType::class, [
                'input' => 'datetime',
                'widget' => 'choice',
                'required' => true
            ])
            ->add('end', TimeType::class, [
                'input' => 'datetime',
                'widget' => 'choice',
                'required' => true
            ])

            ->add('internalCommentary', TextareaType::class, [
                'row_attr' => ['class' => 'text-editor', 'id' => '...',
                ],

            ])
            ->add('project', EntityType::class, [
                'class' => Project::class,
                'choice_label' => 'Project_name',
                'placeholder' => 'Project',
                'label' => 'Project',
                'required' => true
            ])
            ->add('task', EntityType::class, [
                'class' => Tasks::class,
                'choice_label' => 'name',
                'placeholder' => 'wahlt dein Aufgaben',
                'label' => 'Aufgaben',
                'required' => true
            ])
            ->add('submit',SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tracking::class,
        ]);
    }

    /**
     * @param User|null $user
     * @return $this
     */
    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }


}
