<?php

namespace Demos\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Demos\BlogBundle\Entity\User;
use Demos\BlogBundle\Entity\BlogPost;
use Demos\BlogBundle\Entity\BlogCategory;
use Ra\PaginationBundle\Pagination\CPagination;

class BlogController extends Controller
{
    public function indexAction($slug1, $page)
    {
    	$posts = array();
    	$arParams = array();
        $arParams['title'] = 'Блог';
        $arParams['slug1'] = $slug1;

    	$repoPost = $this->getDoctrine()->getRepository('DemosBlogBundle:BlogPost');

        if(preg_match ('/^[0-9]+/', $page)){
            $arParams['page'] = (int) $page;
            $repoCat = $this->getDoctrine()->getRepository('DemosBlogBundle:BlogCategory');
            if($arParams['slug1'] == 'all'){
                $catID = NULL;
            }else{
                $category = $repoCat->findOneBySlug($arParams['slug1']);
                $catID = $category->getId();
            }
        	$postsLength = $repoPost->count_posts(array('catID' => $catID));
        	if($postsLength > 0){
        	    $pager = new CPagination($postsLength);
        	    $arParams['pager'] = $pager->getPager($arParams['page']);

        	    $posts = $repoPost->query_posts(
        	        array(
                        'catID' => $catID,
        	            'quantity' => $arParams['pager']['postsPerPage'], 
        	            'offset' => ($arParams['page'] - 1) * $arParams['pager']['postsPerPage'],
        	            )
        	        );
        	}else{
        	    $posts = false;
        	}
        }else{
            $arParams['detail_slug'] = $page;
            $posts[0] = $repoPost->findOneBySlug($arParams['detail_slug']);
        }

        return $this->render('DemosBlogBundle:Blog:index.html.twig', 
            array(
                'posts' => $posts, 
                'params' => $arParams,
            )
        ); 
    }
}

