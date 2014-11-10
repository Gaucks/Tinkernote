<?php

namespace Tinkernote\SiteBundle\Form;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Security\Core\SecurityContext;

class CommentType extends AbstractType
{
    private $securityContext;

    public function __construct(SecurityContext $securityContext)
    {
        $this->securityContext     = $securityContext;

        $this->user = $this->securityContext->getToken()->getUser();
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('content','text', array('attr' => array('class' => 'form-control input-sm', 'placeholder' => 'Une question ou un commentaire ?')))
            ->add('save','submit', array('label' =>'Envoyer' ,'attr' => array('class' => 'btn btn-blue input-sm')))
            ->remove('date')
            ->remove('user')
            ->remove('annonce')
        ;

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function(FormEvent $event) {
            $form = $event->getForm();
            if ($this->user === 'anon.'){
                $form->add('content','text', array('attr' => array('class' => 'form-control input-sm ','disabled' => 'disabled','placeholder' => 'Une question ou un commentaire ?')))
                     ->add('save','button', array('label' =>'Envoyer' ,'attr' => array('class' => 'btn btn-blue input-sm','disabled' => 'disabled')));
            }
        });
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Tinkernote\SiteBundle\Entity\Comment'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'tinkernote_sitebundle_comment';
    }
}
