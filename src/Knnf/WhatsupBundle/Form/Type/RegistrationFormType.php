<?php

namespace Knnf\WhatsupBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RegistrationFormType extends BaseType
{
    public function __construct()
    {
        $this->class = "Knnf\WhatsupBundle\Entity\User";
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        // add your custom field
        $builder->add('firstname','text',array('label' => 'Prénom'))
            ->add('lastname','text',array('label' => 'Nom'))
            ->add('username','text',array('label' => 'Pseudo'))
            //->add('password')
            ->add('website','text',array('label' => 'Site web','required'    => false))
            ->add('birthday','date',array('widget' => 'single_text',
                                                'input' => 'datetime',
                                                'format' => 'dd/MM/yyyy',
                                                'attr' => array('class' => 'date')
                                                ))
            ->add('country','text',array('label' => 'Pays','required'    => false))
            ->add('city','text',array('label' => 'Ville','required'    => false))
            ->add('description','textarea',array('label' => 'Description','required'    => false))
            ->add('file','file',array('label' => 'Avatar','required'    => false));
            //->add('zipcode','text',array('label' => 'Code postal','required'    => false));
    }

        public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            //'data_class' => $this->class,
            'data_class' => 'Knnf\WhatsupBundle\Entity\User',
            'intention'  => 'registration',
        ));
    }

    public function getName()
    {
        return 'knnf_user_registration';
    }
}