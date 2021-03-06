<?php

namespace Demos\BlogBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
// use Demos\BlogBundle\Entity\User;
use Demos\BlogBundle\Entity\Post;
use Demos\BlogBundle\Entity\Category;
use Ra\PaginationBundle\Pagination\CPagination;

// use Symfony\Component\Security\Core\SecurityContext;

class PortfolioController extends Controller
{
    public function indexAction()
    {
        $arParams = array();
        $arParams['title'] = 'Портфолио';
        return $this->render('DemosBlogBundle:Portfolio:index.html.twig', 
            array(
                'params' => $arParams,
            )
        );
    }

    /**
     * @Route("/portfolio/{slug1}/{slug2}/{page}", defaults={"slug1"="web", "slug2"="all", "page"="1"}, requirements={"page"="\d+"}, name="demos_blog_section")
     */
    public function sectionAction($slug1, $slug2, $page)
    {
        $default_locale =  $this->container->getParameter('locale');
        $locale = $this->get('request')->getLocale();

        $arParams = array();
        $arTest = array();

        $arParams['slug1'] = $slug1;
        $arParams['slug2'] = $slug2;
        $arParams['page'] = $page; 
        
        // категории
        $repoCat = $this->getDoctrine()->getRepository('DemosBlogBundle:Category');
        $rootCategory = $repoCat->findOneBySlug($slug1);

        $category = $repoCat->findOneBySlug($arParams['slug2'] != 'all' ? $arParams['slug2'] : $arParams['slug1']);
        switch ($locale) {
            case 'en':
                $arParams['title'] = $rootCategory->getTitleEn();
                break;
            
            default:
                $arParams['title'] = $rootCategory->getTitle();
                break;
        }
        $arParams['category']['childs'] = $repoCat->getChildren($rootCategory, null, 'sort');
        
        // посты
        $repoPost = $this->getDoctrine()->getRepository('DemosBlogBundle:Post');
        $postsLength = $repoPost->count_posts(array('catID'=>$category->getId()));

        if($arParams['slug2'] == 'all' && !$postsLength && $arParams['category']['childs']) {
            $catID = $arParams['category']['childs'][0] -> getId();
            $postsLength = $repoPost->count_posts(array('catID'=>$catID));
            $arParams['slug2'] = $arParams['category']['childs'][0] -> getSlug();
        }else{
            $catID = $category->getId();
        }
        if($postsLength > 0){
            $pager = new CPagination($postsLength);
            $arParams['pager'] = $pager->getPager($page);

            $posts = $repoPost->query_posts(
                array(
                    'catID' => $catID, 
                    'quantity' => $arParams['pager']['postsPerPage'], 
                    'offset' => ($page - 1) * $arParams['pager']['postsPerPage'],
                    )
                );
        }else{
            $posts = false;
        }

        return $this->render('DemosBlogBundle:Portfolio:section.html.twig', 
            array(
                'posts' => $posts, 
                'params' => $arParams,
                'test' => $arTest,
            )
        );
    }
}

