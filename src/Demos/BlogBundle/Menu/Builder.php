<?php

namespace Demos\BlogBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\Request;

class Builder extends ContainerAware
{
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $repoCat = $this->container->get('doctrine')->getManager()->getRepository('DemosBlogBundle:Category');
        $arCat = $repoCat->childrenHierarchy();
        $menu = $factory->createItem('header_menu');

        $request = $this->container->get('request');
        $title_name = $request->getLocale() == 'ru' ? 'title' : 'title_'.$request->getLocale();

        foreach ($arCat as $cat) {
        	if(in_array($cat['slug'], array('web', 'design', 'photo'))){
	    	    $menu->addChild($cat[$title_name], array(
	    	    	'route' => 'demos_blog_section', 
	    	    	'routeParameters' => array('slug1' => $cat['slug']))
	    		);
	    		if(count($cat['__children']) > 0){
	    			foreach ($cat['__children'] as $subCat) {
		    			$menu[$cat[$title_name]]->addChild($subCat[$title_name], array(
			    	    	'route' => 'demos_blog_section', 
			    	    	'routeParameters' => array('slug1' => $cat['slug'], 'slug2' => $subCat['slug'])
			    	    	)
			    		);
	    			}
	    		}
	    	}
        }
        $menu->addChild('Блог', array('route' => 'demos_blog_blog'));
        $menu->addChild('О себе', array('route' => 'demos_blog_about'));
        $menu->addChild('Контакты', array('route' => 'demos_blog_contacts'));
        return $menu;
    }
    
    public function leftMenu(FactoryInterface $factory, array $options)
    {
        $repoCat = $this->container->get('doctrine')->getManager()->getRepository('DemosBlogBundle:BlogCategory');
        $arCat = $repoCat->findAll();
        $menu = $factory->createItem('left_menu');

        $request = $this->container->get('request');

        foreach ($arCat as $cat) {
            $cat_title = $request->getLocale() == 'ru' ? $cat->getTitle() : $cat->getTitleEn();
    	    $menu->addChild($cat_title, array(
    	    	'route' => 'demos_blog_blog', 
    	    	'routeParameters' => array('slug1' => $cat->getSlug()))
    		);
        }
        return $menu;
    }
}