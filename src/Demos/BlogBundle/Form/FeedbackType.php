<?php

namespace Demos\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FeedbackType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('email');
        $builder->add('mess', 'textarea');
    }


    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Demos\BlogBundle\Entity\Feedback',
        );
    }

    public function getName()
    {
        return 'feadback';
    }
}
