<?php

namespace Demos\BlogBundle\Controller;

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

    public function sectionAction($slug1, $slug2, $page)
    {
        $arParams = array();
        $arTest = array();

        $arParams['slug1'] = $slug1;
        $arParams['slug2'] = $slug2;
        $arParams['page'] = $page; 
        
        // категории
        $repoCat = $this->getDoctrine()->getRepository('DemosBlogBundle:Category');
        $rootCategory = $repoCat->findOneBySlug($slug1);
        $category = $repoCat->findOneBySlug($arParams['slug2'] ? $arParams['slug2'] : $arParams['slug1']);
        $arParams['title'] = $rootCategory->getTitle();
        $arParams['category']['childs'] = $repoCat->getChildren($rootCategory, null, 'sort');
        // $arTest = $repoCat->childrenHierarchy();
        
        // посты
        $repoPost = $this->getDoctrine()->getRepository('DemosBlogBundle:Post');
        $postsLength = $repoPost->countPostsInCategory(array('catID'=>$category->getId()));

        $catID = $category->getId();
        if(!$arParams['slug2'] && !$postsLength && $arParams['category']['childs']) {
            $catID = $arParams['category']['childs'][0] -> getId();
            $postsLength = $repoPost->countPostsInCategory(array('catID'=>$catID));
            $arParams['slug2'] = $arParams['category']['childs'][0] -> getSlug();
        }

        if($postsLength > 0){
            $pager = new CPagination($postsLength);
            $arParams['pager'] = $pager->getPager($page);

            $posts = $repoPost->findByCategory(
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

