<?php

namespace Tinkernote\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RechercheHeaderType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('recherche','text', array('attr'     => array('class'       => 'form-control',
                                                                    'placeholder' =>  'Rechercher une annonce, un vendeur..'
                                                )));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'tinkernote_recherche_header';
    }
}