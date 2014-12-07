<?php
namespace Tinkernote\UserBundle\Form\Type;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use FOS\UserBundle\Form\Type\ProfileFormType as BaseType;
use Symfony\Component\Security\Core\SecurityContext;
use Tinkernote\SiteBundle\Entity\VilleRepository; // A modifier pour extends BaseType


class ProfileFormType extends BaseType
{
    private $entityManager;
    private $class;
    private $securityContext;

    public function __construct($class, EntityManager $entityManager, SecurityContext $securityContext)
    {
        parent::__construct($class);
        $this->entityManager = $entityManager;
        $this->class    = $class;
        $this->securityContext     = $securityContext;

        $this->user = $this->securityContext->getToken()->getUser();
    }

    /**
     * Builds the embedded form representing the user.
     *
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    protected function buildUserForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildUserForm($builder, $options); // Charge les champs d'origine

        $userCity = $this->user->getVille();
        $builder
            ->add('username', null,       array('label' => 'form.username', 'translation_domain' => 'FOSUserBundle'))
            ->add('email', 'email',       array('label' => 'form.email',    'translation_domain' => 'FOSUserBundle'))
            ->add('firstname', null,      array('required' => false ))
            ->add('name', null,           array('required' => false ))
            ->add('phone', 'tel',         array('required' => false ))
            ->add('showphone', 'checkbox',array('required' => false ))
            ->add('age', 'birthday',      array('required' => false,
                                                'label'    => 'Date de naissance:',
                                                'years'    => range(1920, 2000),
                                                'attr'     => array('class' => 'form-group'),
                                                'empty_value' => array('year' => 'Année', 'month' => 'Mois', 'day' => 'Jour')))
            ->add('postal','text',       array('mapped' => false, 'required' => false, 'attr' => array('placeholder' => 'Code postal', 'maxlength' => 5)))
            ->add('ville', 'entity',     array('required'=> true,
                                                              'class' => 'SiteBundle:Ville',
                                                              'property' => 'nom',
                                                              'empty_value'=>'Determiner votre ville...',
                                                              'query_builder' => function(EntityRepository $er) use ($userCity){
                                                               return $er->createQueryBuilder('p')->where('p.id = :usercity')
                                                                                                 ->setParameter('usercity', $userCity);
                                                              },
            ))
            ->add('finalword',null,     array('attr' => array('class' => 'form-control input-sm', 'placeholder' => 'Laisser un mot à ceux qui visite votre profile...')))
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



    public function getName()
    {
        return 'tinkernote_user_profile';
    }
}
