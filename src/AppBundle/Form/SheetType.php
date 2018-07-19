<?php

namespace AppBundle\Form;

use AppBundle\Entity\Analysis;
use AppBundle\Entity\Metier;
use AppBundle\Entity\Statut;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class SheetType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('urgent', CheckboxType::class, [
                'required' => false,
                'label'    => 'La demande est elle urgente ?',
            ])
            ->add('subject', TextType::class, [
                'required' => true,
                'label' => 'Objet de la demande',
                'attr' => array('rows' => '4', 'cols' => '10')
            ])
            ->add('link', UrlType::class, [
                'required' => false,
                'label' => 'Ajouter un lien externe vers un fichier (Ex: WeTransfer, OneDrive, Google Drive, etc.)',
            ])
            ->add('buildings', TextareaType::class, [
                'required' => true,
                'label' => 'Bâtiment concerné',
                'attr' => array('rows' => '2', 'cols' => '10')
            ])
            ->add('constraintsBuildings', TextareaType::class, [
                'required' => false,
                'label' => 'Contraintes de fonctionnement de l\'établissement',
                'attr' => array('rows' => '4', 'cols' => '10')
            ])
            ->add('constraintsTechnicals', TextareaType::class, [
                'required' => false,
                'label' => 'Contraintes techniques',
                'attr' => array('rows' => '4', 'cols' => '10')
            ])
            ->add('description', TextareaType::class, [
                'required' => true,
                'label' => 'Description de la demande',
                'attr' => array('rows' => '4', 'cols' => '10')
            ])
            ->add('startWork', DateType::class, [
                'required' => false,
                'label' => 'Début souhaité des travaux',
                'widget' => 'single_text',
                'html5' => true,
                'attr' => ['placeholder' => 'AAAA-MM-JJ']
            ])
            ->add('endWork', DateType::class, [
                'required' => false,
                'label' => 'Fin souhaitée des travaux',
                'widget' => 'single_text',
                'html5' => true,
                'attr' => ['placeholder' => 'AAAA-MM-JJ']
            ])
            ->add('job', EntityType::class, [
                'required' => false,
                'class' => Metier::class,
                'label' => 'Métier concerné',
                'placeholder' => 'Choisir un métier',
                'choice_label' => function ($name) {
                    return $name->getName();
                }
            ])
            ->add('analysis', EntityType::class, [
                'required' => false,
                'class' => Analysis::class,
                'label' => 'Votre analyse',
                'choice_label' => 'name'
            ])
            ->add('status', EntityType::class, [
                'required' => false,
                'class' => Statut::class,
                'label' => 'Statut',
                'choice_label' => 'name'
            ])
            ->add('contactPeople', TextType::class, [
                'label' => 'Personne à contacter en cas d\'absence',
                'required' => false,
                'attr' => array(
                    'placeholder' => 'Nom / Téléphone / Email',
                )
            ])
            ->add('realStartWork', DateType::class, [
                'label' => 'Début effectif des travaux',
                'widget' => 'single_text',
                'html5' => true,
                'attr' => ['placeholder' => 'AAAA-MM-JJ']
            ])
            ->add('realEndWork', DateType::class, [
                'label' => 'Fin effective des travaux',
                'widget' => 'single_text',
                'html5' => true,
                'attr' => ['placeholder' => 'AAAA-MM-JJ']
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Sheet'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_sheet';
    }
}
