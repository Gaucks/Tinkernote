<?php

namespace Tinkernote\SiteBundle\Form;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Security\Core\SecurityContext;

class AnnonceType extends AbstractType
{
    private $entityManager;
    private $securityContext;

    public function __construct(EntityManager $entityManager, SecurityContext $securityContext)
    {
        $this->entityManager = $entityManager;
        $this->securityContext     = $securityContext;

        $this->user = $this->securityContext->getToken()->getUser();
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    $builder->add('date',           'date',             array(  'input' => 'datetime',
                                                                'widget' => 'single_text',
                                                                'format' => 'yyyy-MM-dd',
                                                                'required' => false))
            ->add('picture',        new PictureType(),  array('required' => false))
            ->add('picturetwo',     new PictureType(),  array('required' => false))
            ->add('picturethree',   new PictureType(),  array('required' => false))
            ->add('picturefour',    new PictureType(),  array('required' => false))
            ->add('title',          'text',             array('required' => true, 'attr'     => array('maxlength' => 80)))
            ->add('content',        'textarea',         array('required' => true, 'attr'     => array('placeholder' => 'Le contenu de votre annonce')))
            ->add('price',          'text',             array('required' => false))
            ->add('parentCategory', 'entity',           array('required' => true, 'class'     => 'SiteBundle:ParentCategory', 'property' => 'parent', 'empty_value' => 'La categorie'))
            ->add('category',       'entity',           array('required' => true, 'class'     => 'SiteBundle:Category', 'property' => 'category', 'empty_value' => 'La rubrique'))
            ->add('postal',         'text',             array('required' => true, 'mapped'    =>  false, 'attr' => array('class' => 'form-control input-sm postal', 'placeholder' => 'Code postal', 'maxlength' => '5')))
        ;

        $builder->remove('user');

        $builder->addEventListener(FormEvents::PRE_SET_DATA, array($this, 'onPreSetData'));
        $builder->get('postal')->addEventListener(FormEvents::POST_SUBMIT, array($this, 'onPostSubmitData'));
    }

    public function onPreSetData(FormEvent $event)
    {
        $annonce = $event->getData();
        $form = $event->getForm();

        if(!$annonce || null === $annonce->getId())
        {
            $userPostal = $this->user->getVille();

            $form->add('ville', 'entity', array('required'=> true,
                'class' => 'SiteBundle:Ville',
                'property' => 'nom',
                'query_builder' => function(EntityRepository $er) use ($userPostal){
                    return $er->createQueryBuilder('p')->where('p.postal = :userpostal')
                        ->setParameter('userpostal', $userPostal->getPostal());
                },
            ));
        }
        else{
            $form->add('ville', 'entity', array('required'=> true,
                'class' => 'SiteBundle:Ville',
                'property' => 'nom',
                'query_builder' => function(EntityRepository $er) use ($annonce){
                    return $er->createQueryBuilder('p')->where('p.postal = :userpostal')
                        ->setParameter('userpostal', $annonce->getVille()->getPostal());
                },
            ));
        }
    }

    public function onPostSubmitData(FormEvent $event)
    {
        $formModifier = function(FormInterface $form, $cp ){

            $villeCodePostal = $this->entityManager->getRepository('SiteBundle:Ville')->findBy(array('postal' => $cp));

            if ($villeCodePostal) {
                $villes = array();
                foreach ($villeCodePostal as $ville) {
                    $villes[] = array($ville->getNom());
                }
            }
            else{
                $villes[] = array($this->user->getVille()->getNom());
            }

            $form->add('ville', 'entity', array('attr' => array('class' => 'ville'),'class' => 'SiteBundle:Ville', 'property' => 'nom', 'empty_value'=>'Votre ville','query_builder' => function(EntityRepository $er) use ($villes){
                return $er->createQueryBuilder('p')->where('p.nom IN (:cp)')->setParameter('cp' , $villes);
            }));
        };
        $formModifier($event->getForm()->getParent(), $event->getForm()->getData());
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
