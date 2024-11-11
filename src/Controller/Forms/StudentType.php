<?php

namespace App\Controller\Forms;

use App\Entity\Gender;
use App\Entity\LearningStyle;
use App\Entity\Neurodiversity;
use App\Entity\StudentInfo;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StudentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class)
            ->add('email', TextType::class)
            ->add('phone_number', NumberType::class)
            ->add('preferred_name', TextType::class, ['required' => false])
            ->add('gender', EntityType::class, [
                'class' => Gender::class,
                'choice_label' => 'gender',
            ])
            ->add('ethnicity', TextType::class)
            ->add('nz_citizen', CheckboxType::class, ['required' => false])
            ->add('date_of_birth', DateType::class, ['widget' => 'single_text'])
            ->add('neurodiversity', EntityType::class, [
                'class' => Neurodiversity::class,
                'choice_label' => 'neurodiversity',
                'required' => false,
            ])
            ->add('learning_style', EntityType::class, [
                'class' => LearningStyle::class,
                'choice_label' => 'learning_style',
                'required' => false, ])
            ->add('submit', SubmitType::class)
            ->getForm();
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class' => StudentInfo::class]);
    }
}
