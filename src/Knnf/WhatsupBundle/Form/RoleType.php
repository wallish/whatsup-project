<?php

namespace Knnf\WhatsupBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RoleType extends AbstractType
{

    private $choices;

    public function __construct( $choices)
    {
      $this->choices = $choices;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        
        $builder
            ->add('name','text', array('label' => 'Nom du role','attr' => array('class' => 'form-control')))
            ->add('rights','choice', [
            'choices' => $this->choices,
            'multiple' => true,
            'expanded' => true,
            'label' => 'Liste des droits',

        ])  
    ;

            //->add('activate')
            //->add('dateinsert')
            //->add('dateupdate')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Knnf\WhatsupBundle\Entity\Role'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'knnf_whatsupbundle_role';
    }
}
