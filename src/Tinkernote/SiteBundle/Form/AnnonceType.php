<?php

namespace Tinkernote\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Null;

class AnnonceType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('picture')
            ->add('title')
            ->add('content','textarea',         array('required' => true, 'attr' => array('class' => 'form-control form-annonce  input-sm', 'placeholder' => 'Le contenu de votre annonce')))
            ->add('date')
            ->add('price')
            ->add('user')
            ->add('region','entity',            array('required' => false, 'class' => 'SiteBundle:Region', 'property' => 'nom', 'empty_value' => 'Votre région', 'attr' => array('class' => 'input-sm form-control regionclass')))
            ->add('departement','entity',       array('required' => false, 'class' => 'SiteBundle:Departement', 'property' => 'nom', 'empty_value' => 'Votre département','attr' => array('class' => 'input-sm form-control departementclass')))
            ->add('ville','entity',             array('required' => false, 'class' => 'SiteBundle:Ville', 'property' => 'nom', 'empty_value' => 'Votre ville','attr' => array('class' => 'input-sm form-control villeclass')))
            ->add('parentCategory','entity',    array('required' => false, 'class' => 'SiteBundle:ParentCategory', 'property' => 'parent', 'empty_value' => 'La categorie'))
            ->add('category','entity',          array('required' => false, 'class' => 'SiteBundle:Category', 'property' => 'category', 'empty_value' => 'La rubrique'))
        ;

        $builder->remove('date')
                ->remove('user')
                ->remove('picture')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Tinkernote\SiteBundle\Entity\Annonce'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'tinkernote_sitebundle_annonce';
    }
}
