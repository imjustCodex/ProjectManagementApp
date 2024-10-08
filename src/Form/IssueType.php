<?php

// src/Form/IssueType.php
namespace App\Form;

use App\Entity\Issue;
use App\Entity\Task;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IssueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, [
                'label' => 'Issue Name',
                'attr' => ['class' => 'form-control', 'placeholder' => 'Enter issue name'],
            ])
            ->add('description', null, [
                'label' => 'Description',
                'attr' => ['class' => 'form-control', 'placeholder' => 'Enter description'],
            ])
            ->add('status', ChoiceType::class, [
                'choices' => array_flip(Issue::STATUS_OPTIONS),
                'label' => 'Status',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('createdAt', null, [
                'label' => 'Created At',
                'widget' => 'single_text',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('deadline', null, [
                'label' => 'Deadline',
                'widget' => 'single_text',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('assignedUsers', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'email',
                'multiple' => true,
                'expanded' => true,
                'by_reference' => false, // Important for ManyToMany relationship
                'attr' => ['class' => 'form-check-list'],
            ])
            ->add('timeSpent', IntegerType::class, [
                'label' => 'Time Spent (hours)',
                'attr' => ['class' => 'form-control'],
                'required' => false,
            ])
            ->add('task', EntityType::class, [
                'class' => Task::class,
                'choice_label' => 'name',
                'label' => 'Select Task',
                'attr' => ['class' => 'form-control']
            ]);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Issue::class,
        ]);
    }
}
