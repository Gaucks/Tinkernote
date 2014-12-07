<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tinkernote\UserBundle\Form\Type;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;

class RegistrationFormType extends BaseType
{
    private $entityManager;
    private $class;

    public function __construct($class, EntityManager $entityManager)
    {
        parent::__construct($class);
        $this->entityManager = $entityManager;
        $this->class    = $class;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', 'email', array('label' => 'form.email', 'translation_domain' => 'FOSUserBundle', 'attr' => array('class' => 'form-control','placeholder' => 'Adresse Email')))
            ->add('username', null, array('label' => 'form.username', 'translation_domain' => 'FOSUserBundle', 'attr' => array('class' => 'form-control', 'placeholder' => 'Nom d\'utilisateur')))
            ->add('plainPassword', 'repeated', array(
                'type' => 'password',
                'options' => array('translation_domain' => 'FOSUserBundle'),
                'first_options' => array('label' => 'form.password', 'attr' => array('class' => 'form-control', 'placeholder' => 'Mot de passe')),
                'second_options' => array('label' => 'form.password_confirmation', 'attr' => array('class' => 'form-control', 'placeholder' => 'Vérification du mot de passe')),
                'invalid_message' => 'fos_user.password.mismatch',
            ))
            ->add('postal','text', array('mapped' => false, 'required' => false, 'attr' => array('placeholder' => 'Code postal', 'maxlength' => 5)))
            ->add('ville', 'entity', array('required'=> true,
                'attr'  => array('class' => 'form-control input-sm ville'),
                'class' => 'SiteBundle:Ville',
                'property' => 'nom',
                'empty_value'=>'Determiner votre ville...',
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('p')->setMaxResults(0);
                },))
        ;

        $formModifier = function(FormInterface $form, $cp ){

            $villeCodePostal = $this->entityManager->getRepository('SiteBundle:Ville')->findBy(array('postal' => $cp));

            if ($villeCodePostal) {
                $villes = array();
                foreach ($villeCodePostal as $ville) {
                    $villes[] = array($ville->getNom());
                }
            }
            else{
                $villes[] = null;
            }

            $form->add('ville', 'entity', array('attr' => array('class' => 'form-control input-sm ville'),
                                                'class' => 'SiteBundle:Ville',
                                                'property' => 'nom',
                                                'empty_value'=>'Votre ville',
                                                'query_builder' => function(EntityRepository $er) use ($villes){
                                                return $er->createQueryBuilder('p')->where('p.nom IN (:cp)')->setParameter('cp' , $villes);
            }));
        };
        $builder->get('postal')->addEventListener(FormEvents::POST_SUBMIT, function(FormEvent $event) use ($formModifier){
            $formModifier($event->getForm()->getParent(), $event->getForm()->getData());
        });
    }

    public function getParent()
    {
        return 'fos_user_registration';
    }

    public function getName()
    {
        return 'tinkernote_user_registration';
    }
}
