<?php

namespace AppBundle\Form;

use AppBundle\Entity\Department;
use AppBundle\Entity\Lycee;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('roles', ChoiceType::class, [
                'label' => 'Type d\'utilisateur',
                'choices' => [
                    'Admin Region' => 'ROLE_ADMIN',
                    'EMOP' => 'ROLE_EMOP',
                    'Lycée' => 'ROLE_LYCEE',
                ],
                'expanded' => true,
                'multiple' => true,
                'required' => true,
            ])
            ->add('firstName', TextType::class, [
                'attr' => ['maxlength' => '255', 'minlength' => '2'],
                'label' => 'Prénom',
                'required' => true,
            ])
            ->add('lastName', TextType::class, [
                'attr' => ['maxlength' => '255', 'minlength' => '2'],
                'label' => 'Nom de famille',
                'required' => true,
            ])
            ->add('work', TextType::class, [
                'attr' => ['maxlength' => '255', 'minlength' => '2'],
                'label' => 'Fonction / Poste',
                'required' => true,
            ])
            ->add('phoneNumber', TelType::class, [
                'attr' => ['maxlength' => '30', 'minlength' => '10'],
                'label' => 'Numéro de téléphone',
                'required' => true,
            ])
            ->add('mail', EmailType::class, [
                'attr' => ['maxlength' => '255'],
                'label' => 'Courriel',
                'required' => true,
            ])
            ->add('lycee', EntityType::class, [
                'required' => false,
                'class' => Lycee::class,
                'label' => 'Lycée',
                'placeholder' => 'Choisir un Lycée',
                'choice_label' => function ($name) {
                    return $name->getName();
                }
            ])
            ->add('departments', EntityType::class, [
                'required' => false,
                'class' => Department::class,
                'label' => 'Departement',
                'placeholder' => 'Choisir un département',
                'choice_label' => 'nameAndCode',
                'expanded' => true,
                'multiple' => true,
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\User'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_user';
    }
}
