<?php

namespace Tinkernote\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\False;

class RechercheType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('recherche','text', array('required'      => false))
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
        return 'tinkernote_recherche';
    }
}