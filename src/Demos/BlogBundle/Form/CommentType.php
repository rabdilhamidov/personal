<?php

namespace Demos\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('body', 'textarea');
        $builder->add('save', 'submit', array(
            'attr' => array('class' => 'green'),
        ));
    }


    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Demos\BlogBundle\Entity\BlogComment',
        );
    }

    public function getName()
    {
        return 'comment';
    }
}
