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
        $builder->add('firstname')
            ->add('lastname')
            ->add('username')
            ->add('password')
            ->add('website')
            ->add('birthday')
            ->add('photo')
            ->add('country')
            ->add('city')
            ->add('zipcode');
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