<?php

namespace AppBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfilType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, [
                'label' => 'Votre prénom',
                'attr' => array('rows' => '4', 'cols' => '10')
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Votre nom',
                'attr' => array('rows' => '4', 'cols' => '10')
            ])
            ->add('work', TextType::class, [
                'label' => 'Fonction',
                'attr' => array('rows' => '4', 'cols' => '10')
            ])
            ->add('phoneNumber', TextType::class, [
                'label' => 'Téléphone',
                'attr' => array('rows' => '4', 'cols' => '10')
            ]);

        $builder->remove('username')->remove('email');
    }

    /**
     * {@inheritdoc}
     */

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\ProfileFormType';
    }

    public function getBlockPrefix()
    {
        return 'app_user_profile';
    }

    public function getName()
    {
        return $this->getBlockPrefix();
    }
}
