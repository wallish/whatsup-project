<?php

namespace Knnf\WhatsupBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname')
            ->add('lastname')
            ->add('username')
            ->add('email')
            ->add('password')
            ->add('website')
             ->add('birthday','date',array('widget' => 'single_text',
                                                'input' => 'datetime',
                                                'format' => 'dd/MM/yyyy',
                                                'attr' => array('class' => 'date')
                                                ))
            ->add('photo')
            ->add('country')
            ->add('city')
            ->add('zipcode')
            ->add('description')
            //->add('dateinsert')
            //->add('dateupdate')
            //->add('activate')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Knnf\WhatsupBundle\Entity\User'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'knnf_whatsupbundle_user';
    }
}
