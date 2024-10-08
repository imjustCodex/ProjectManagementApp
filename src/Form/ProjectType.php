<?php

// src/Form/ProjectType.php

namespace App\Form;

use App\Entity\Brand;
use App\Entity\Project;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Project Name',
                'attr' => ['class' => 'form-control', 'placeholder' => 'Enter project name'],
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'required' => false,
                'attr' => ['class' => 'form-control', 'placeholder' => 'Enter project description'],
            ])
            ->add('status', ChoiceType::class, [
            'choices' => array_flip(Project::STATUS_OPTIONS),
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
            ->add('brand', EntityType::class, [
                'class' => Brand::class,
                'choice_label' => 'name',
                'label' => 'Select Brand',
                'attr' => ['class' => 'form-control']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
