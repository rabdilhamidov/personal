<?php

namespace Knp\Bundle\PaginatorBundle\Twig\Extension;


class PaginationExtension extends \Twig_Extension
{
    /**
     * @var \Twig_Environment
     */
    protected $environment;

    /**
     * {@inheritDoc}
     */
    public function getFunctions()
    {
        return array(
            'ra_pagination_render' => new \Twig_Function_Method($this, 'render', array('is_safe' => array('html'))),
        );
    }


    public function render($pagination)
    {
        return $this->environment->render(
            $template ?: $pagination->getTemplate())
        );
    }


    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return 'ra_pagination';
    }
}
