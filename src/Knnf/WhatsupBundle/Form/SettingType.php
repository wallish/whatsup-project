<?php

namespace Knnf\WhatsupBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SettingType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('category','entity', array('class' => 'KnnfWhatsupBundle:Category','property' => 'name','empty_value' => 'Par défaut','empty_data'  => null,'required'    => false))
            ->add('category2','entity', array('class' => 'KnnfWhatsupBundle:Category','property' => 'name','empty_value' => 'Par défaut','empty_data'  => null,'required'    => false))
            ->add('category3','entity', array('class' => 'KnnfWhatsupBundle:Category','property' => 'name','empty_value' => 'Par défaut','empty_data'  => null,'required'    => false))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            //'data_class' => 'Knnf\WhatsupBundle\Entity\Setting'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'knnf_whatsupbundle_setting';
    }
}
