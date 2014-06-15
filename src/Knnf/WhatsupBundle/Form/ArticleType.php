<?php

namespace Knnf\WhatsupBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ArticleType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('slug')
           // ->add('content')
            ->add('content', 'textarea', array('attr' => array('class' => 'ckeditor')))
            //->add('picture')
            //->add('status')
            //->add('dateinsert')
            //->add('dateupdate')
            //->add('activate')
            ->add('file','file',array('required' => false))
            ->add('path','text',array('required' => false))
            ->add('push','checkbox',array('required' => false))
            ->add('category','entity', array('class' => 'KnnfWhatsupBundle:Category','property' => 'name'))
            ->add('user','entity', array('class' => 'KnnfWhatsupBundle:User','property' => 'id'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Knnf\WhatsupBundle\Entity\Article'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'knnf_whatsupbundle_article';
    }
}
