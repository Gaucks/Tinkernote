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
        $userPostal = $this->user->getVille(); // Selection toutes les villes dans le départements de l'utilisateur - Il faut ensuite selectionner sa ville et la mettre en selected=selected
        $builder
            //->add('picture', new PictureType())
            ->add('title','text',               array('attr' => array('maxlength' => 80)))
            ->add('content','textarea',         array('required' => true, 'attr' => array('placeholder' => 'Le contenu de votre annonce')))
            ->add('date')
            ->add('price','text',                array('required' => false))
            ->add('user')
            ->add('parentCategory','entity',    array('required' => true, 'class' => 'SiteBundle:ParentCategory', 'property' => 'parent', 'empty_value' => 'La categorie'))
            ->add('category','entity',          array('required' => true, 'class' => 'SiteBundle:Category', 'property' => 'category', 'empty_value' => 'La rubrique'))
            ->add('postal','text',              array('required' => true, 'mapped' => false,'attr' => array('class' => 'form-control input-sm postal', 'placeholder' => 'Code postal', 'maxlength' => '5')))
            ->add('ville', 'entity', array('required'=> true,
                'class' => 'SiteBundle:Ville',
                'property' => 'nom',
                'query_builder' => function(EntityRepository $er) use ($userPostal){
                    return $er->createQueryBuilder('p')->where('p.postal = :userpostal')
                        ->setParameter('userpostal', $userPostal->getPostal());
                },
            ))
        ;

        $builder->remove('date')
                ->remove('user')
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
                $villes[] = array($this->user->getVille()->getNom());
            }

            $form->add('ville', 'entity', array('attr' => array('class' => 'ville'),'class' => 'SiteBundle:Ville', 'property' => 'nom', 'empty_value'=>'Votre ville','query_builder' => function(EntityRepository $er) use ($villes){
                return $er->createQueryBuilder('p')->where('p.nom IN (:cp)')->setParameter('cp' , $villes);
            }));
        };

        $builder->get('postal')->addEventListener(FormEvents::POST_SUBMIT, function(FormEvent $event) use ($formModifier){
            $formModifier($event->getForm()->getParent(), $event->getForm()->getData());
        });
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
