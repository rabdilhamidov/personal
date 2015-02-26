<?php

namespace Demos\BlogBundle\Twig\Extension;

class DemosBlogExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            'excerpt' => new \Twig_Filter_Method($this, 'excerpt_filter'),
        );
    }

    public function excerpt_filter($string, $limit=300)
    {

        return mb_substr(strip_tags($string), 0, $limit, 'UTF-8').' ...';
    }

    public function getName()
    {
        return 'demos_blog_extension';
    }
}
