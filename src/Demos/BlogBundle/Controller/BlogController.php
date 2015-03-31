<?php

namespace Demos\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Demos\BlogBundle\Entity\User;
use Demos\BlogBundle\Entity\BlogPost;
use Demos\BlogBundle\Entity\BlogCategory;
use Demos\BlogBundle\Entity\BlogComment;
use Demos\BlogBundle\Form\CommentType;
use Ra\PaginationBundle\Pagination\CPagination;

class BlogController extends Controller
{
    public function indexAction($slug1, $page)
    {
        $posts = array();
        $arParams = array();
        $arParams['title'] = 'Блог';
        $arParams['slug1'] = $slug1;
        $comment_form_view = false;
        $comments = false;

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
            // детальная страница
            $arParams['detail_slug'] = $page;
            $posts[0] = $repoPost->findOneBySlug($arParams['detail_slug']);

            $repoComments = $this->getDoctrine()->getRepository('DemosBlogBundle:BlogComment');
            $comments = $repoComments->query_comments(
                    array(
                        'postID'    => $posts[0]->getId(),
                        'quantity'  => 20, 
                        )
                    );


            $request = $this->container->get('request');
            $comment_form_view = false;
            if ($this->get('security.context')->isGranted('ROLE_USER')){
                $comment = new BlogComment();
                $comment_form = $this->createForm(new CommentType(), $comment);
                if ($request->getMethod() == 'POST') {
                    $comment_form->handleRequest($request);

                    if ($comment_form->isValid()) {
                        $comment->setPost($posts[0]->getId());
                        $comment->setUser($this->getUser());
                        $em = $this->getDoctrine()->getEntityManager();
                        $em->persist($comment);
                        $em->flush();
                        return $this->redirect($request->getRequestUri());
                    }
                }
                $comment_form_view = $comment_form->createView();
            }
        }

        return $this->render('DemosBlogBundle:Blog:index.html.twig', 
            array(
                'posts' => $posts, 
                'params' => $arParams,
                'comments'  => $comments,
                'comment_form'=> $comment_form_view
            )
        ); 
    }

    public function commentAction($id, $act){

        echo 'commentID:'.$id.'<br>';
        echo 'action:'.$act.'<br>';

        $response = new Response();
        $response->headers->set('Content-Type', 'text/html');
        $response->setCharset('UTF-8');
        $response->setStatusCode(Response::HTTP_OK);

        return $response;
    }
}

