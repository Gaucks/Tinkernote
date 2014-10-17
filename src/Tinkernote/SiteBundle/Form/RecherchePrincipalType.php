<?php

namespace Tinkernote\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RecherchePrincipalType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('recherche','search', array('required'      => false,
                                                  'attr'          => array('class'       => "form-control btn-form-search input-sm",
                                                                           'placeholder' => "Rechercher une annonce, un vendeur, un produit",
                                                                           'id'          => "annonce-search"
        )))
                ->add('region','entity',  array('required'      => false,
                                                'class'         => 'SiteBundle:Region',
                                                'property'      => 'nom',
                                                'empty_value'   => 'Toute la france',
                                                'attr' => array('class' => 'form-control input-sm')))
        ;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'tinkernote_recherche_principal';
    }
}