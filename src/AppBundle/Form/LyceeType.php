<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class LyceeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name' ,TextType::class, [
                'label' => 'Nom de Lycee',
                'attr' => [
                    'maxlength' => 50,
                    'require'=> true
                ]
            ])
            ->add('address',TextType::class, [
                'label' => 'Addresse',
                'attr' => [
                    'maxlength' => 30,
                    'require'=> true
                ]
            ])
            ->add('postalCode',TextType::class, [
                'label' => 'Code postal',
                'attr' => [
                    'maxlength' => 5,
                    'require'=> true
                ]
            ])
            ->add('city',TextType::class, [
                'label' => 'Ville',
                'attr' => [
                    'maxlength' => 28,
                    'require'=> true
                ]
            ])
            ->add('departments');
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Lycee'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_lycee';
    }
}
