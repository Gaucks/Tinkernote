<?php
namespace Tinkernote\UserBundle\Form\Type;

use FOS\UserBundle\Form\Type\ProfileFormType as BaseType; // A modifier pour extends BaseType
use Symfony\Component\Form\FormBuilderInterface;

class ProfileFormType extends BaseType
{
    /**
     * Builds the embedded form representing the user.
     *
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    protected function buildUserForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildUserForm($builder, $options); // Charge les champs d'origine

        $builder
            ->add('username', null,       array('label' => 'form.username', 'translation_domain' => 'FOSUserBundle'))
            ->add('email', 'email',       array('label' => 'form.email', 'translation_domain' => 'FOSUserBundle'))
            ->add('region','entity',      array('required' => false, 'class' => 'SiteBundle:Region', 'property' => 'nom', 'empty_value' => 'Votre région'))
            ->add('departement','entity', array('required' => false, 'class' => 'SiteBundle:Departement', 'property' => 'nom', 'empty_value' => 'Votre département'))
            ->add('ville','entity',       array('required' => false, 'class' => 'SiteBundle:Ville', 'property' => 'nom', 'empty_value' => 'Votre ville'))
            ->add('firstname', null,      array('required' => false ))
            ->add('name', null,           array('required' => false))
            ->add('phone', 'tel',         array('required' => false))
            ->add('showphone', 'checkbox',array('required' => false))
            ->add('age', 'birthday',      array('required' => false,
                                                'label'    => 'Date de naissance:',
                                                'years'    => range(1920, 2000),
                                                'attr'     => array('class' => 'form-group'),
                                                'empty_value' => array('year' => 'Année', 'month' => 'Mois', 'day' => 'Jour')))
        ;
    }

    public function getName()
    {
        return 'tinkernote_user_profile';
    }
}
