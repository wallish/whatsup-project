<?php

namespace Knnf\WhatsupBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EventType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description', 'textarea', array('attr' => array('class' => 'ckeditor')))
            ->add('place')
            ->add('address')
            ->add('orderlink')
            ->add('activate')
            ->add('datestart','date',array('widget' => 'single_text',
                                                'input' => 'datetime',
                                                'format' => 'dd/MM/yyyy',
                                                'attr' => array('class' => 'date')
                                                ))
            ->add('dateend','date',array('widget' => 'single_text',
                                                'input' => 'datetime',
                                                'format' => 'dd/MM/yyyy',
                                                'attr' => array('class' => 'date')
                                                ))
            ->add('hourstart')
            ->add('hourend')
            ->add('category','entity', array('class' => 'KnnfWhatsupBundle:Category','property' => 'name','attr' => array('class' => 'form-control')))
            
            //->add('dateinsert')
            //->add('dateupdate')
            //->add('user')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Knnf\WhatsupBundle\Entity\Event'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'knnf_whatsupbundle_event';
    }
}
