<?php

namespace Demos\BlogBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Demos\BlogBundle\Entity\User;
use Demos\BlogBundle\Entity\Post;
use Demos\BlogBundle\Entity\Category;
use Demos\BlogBundle\Form\FeedbackType;
use Demos\BlogBundle\Entity\Feedback;
use Symfony\Component\Security\Core\SecurityContext;
use Application\Sonata\MediaBundle\Entity\Media;
use Application\Sonata\MediaBundle\Entity\Gallery;
use Application\Sonata\MediaBundle\Entity\GalleryHasMedia;

class DefaultController extends Controller
{
	/**
	 * @Route("/", name="demos_blog_homepage")
	 */
    public function indexAction()
    {

    	// главный баннер
    	$repoGallery = $this->getDoctrine()->getRepository('ApplicationSonataMediaBundle:Gallery');
    	$galleryMainBanner = $repoGallery->findOneBy(array('name' => 'main_banner'));
    	$repoGalleryHasMedia = $this->getDoctrine()->getRepository('ApplicationSonataMediaBundle:GalleryHasMedia');
    	$galleryHasMedias = $repoGalleryHasMedia->findBy(
    		array('gallery' => array('id'=>$galleryMainBanner->getId())),
    		array('position' => 'ASC')
    	);
    	$mainBannerImgs = array();
    	foreach ($galleryHasMedias as $galleryHasMedia) {
    		$mainBannerImgs[] = $galleryHasMedia->getMedia();
    	}

    	$repoCat = $this->getDoctrine()->getRepository('DemosBlogBundle:Category');
    	$repoPost = $this->getDoctrine()->getRepository('DemosBlogBundle:Post');
    	
    	// вэб
    	$posts = array();
    	$web = $repoCat->findOneBySlug('web');
    	$arCat = $repoCat->getChildren($web, false, 'sort', 'asc');
    	$arCatId = array();
    	foreach ($arCat as $cat) {
    		$arCatId[] = $cat->getId();
    	}
    	$posts['web'] = $repoPost->query_posts(array('catID' => $arCatId, 'quantity' => 9, 'orderBy' => 'sort'));
    	unset($arCatId);

    	// дизайн
    	$design = $repoCat->findOneBySlug('design');
    	$arCat = $repoCat->getChildren($design, false, 'sort', 'asc');
    	$arCatId = array();
    	foreach ($arCat as $cat) {
    		$arCatId[] = $cat->getId();
    	}
    	$posts['design'] = $repoPost->query_posts(array('catID' => $arCatId, 'quantity' => 9, 'orderBy' => 'sort'));

    	// Фото
    	$photos = $repoCat->findOneBySlug('photo');
    	$arPhotos = $repoCat->getChildren($photos, false, 'sort', 'asc');
    	$arPhotosId = array();
    	foreach ($arPhotos as $photo) {
    		$arPhotosId[] = $photo->getId();
    	}
    	$posts['photo'] = $repoPost->query_posts(array('catID' => $arPhotosId, 'quantity' => 9, 'orderBy' => 'sort'));

    	// Блог
    	$repoBlogPost = $this->getDoctrine()->getRepository('DemosBlogBundle:BlogPost');

    	$posts['blog'] = $repoBlogPost->query_posts(array('quantity' => 9, 'orderBy' => 'sort'));

    	// echo $locale = $this->get('request')->getLocale();

        return $this->render('DemosBlogBundle:Default:index.html.twig', 
        	array(
        		'posts' => $posts, 
        		'mainBannerImgs' => $mainBannerImgs,
    		)
    	);
    }

    public function feedbackAction($request){
    	$feedback = new Feedback();
    	$form = $this->createForm(new FeedbackType(), $feedback);
    	$isPostData = false;


    	if ($request->getMethod() == 'POST') {
    		$isPostData = true;
    	    $form->handleRequest($request);

    	    if ($form->isValid()) {
    	        // отправляем почту
    	        $authorEmail = $form->get('email')->getViewData();
    	        $body = $form->get('mess')->getViewData()."\r\n <br/>";
    	        $body .= 'Отправитель: <a href="mailto:'.$authorEmail.'">'.$authorEmail.'</a>';
    	        $this->sendMail($body);
    	    }
    	}
	    return $this->render('DemosBlogBundle:Default:feedback.html.twig', 
	    	array(
	    		'form'				=> $form->createView(),
	    		'isPostData'		=> $isPostData,
	    		'isFbkFormValid'	=> $form->isValid(),
			)
		);
    }

    public function loginAction($request){
    	$session = $request->getSession();
    	// получить ошибки логина, если таковые имеются
    	if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
    	    $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
    	} else {
    	    $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
    	}
	    return $this->render('DemosBlogBundle:Default:headerLogin.html.twig', 
	    	array(
	    		'last_username' => $session->get(SecurityContext::LAST_USERNAME),
        		'error'         => $error,
        		'redirectUrl'	=> $request->getUri()
			)
		);
    }


    /**
     * @Route("/about_me", name="demos_blog_about")
     */
    public function aboutmeAction(){
	    return $this->render('DemosBlogBundle:Default:aboutme.html.twig');
    }

    /**
     * @Route("/contacts", name="demos_blog_contacts")
     */
    public function contactsAction(){
	    return $this->render('DemosBlogBundle:Default:contacts.html.twig');
    }


    private function sendMail($mailbody, $sendFrom = 'admin@mail.ra', $sentTo='rus-abd@ukr.net')
    {
    	// получаем 'mailer' (обязателен для инициализации Swift Mailer)
    	$mailer = $this->get('mailer');

    	$message = \Swift_Message::newInstance()
    	    ->setSubject('Обращение с персонального сайта')
    	    ->setFrom($sendFrom)
    	    ->setTo($sentTo)
    	    ->setBody($this->renderView('DemosBlogBundle:Default:mailbody_feedback.html.twig', array('mailbody' => $mailbody)))
    	    ->setContentType('text/html')
    	;

    	$result = $mailer->send($message);
    	return $result;
    }




/*
*/
	public function createUserAction()
	{
	    $user = new User();
	    $user->setName('Rus');
	    $user->setSurname('Abdilkhamidov');
	    $user->setEmail('rus-abd@ukr.net');
	    $user->setBirthdate(new \DateTime("1971-11-23"));

	    $em = $this->getDoctrine()->getManager();
	    $em->persist($user);
	    $em->flush();

	    return new Response('Created user id '.$user->getId().' ('.$user->getName().' '.$user->getSurname().')');
	}

	// public function createPostAction()
	// {
	//     $post = new Post();
	//     $post->setTitle('Demo Blog');
	//     $post->setBody('Названия ваших сервисов должны быть как можно более коротки и просты, в идеале это должно быть одно слово');
	//     $post->setCreatedDate(new \DateTime("now"));
	//     $post->setUpdatedDate(new \DateTime('now'));

	//     $em = $this->getDoctrine()->getManager();
	//     $em->persist($post);
	//     $em->flush();

	//     return new Response('Created post id ' . $post->getId());
	// }

	// public function setCategoriesAction()
	// {
	// 	$food = new Category();
	// 	$food->setTitle('Food');

	// 	$fruits = new Category();
	// 	$fruits->setTitle('Fruits');
	// 	$fruits->setParent($food);

	// 	$vegetables = new Category();
	// 	$vegetables->setTitle('Vegetables');
	// 	$vegetables->setParent($food);

	// 	$carrots = new Category();
	// 	$carrots->setTitle('Carrots');
	// 	$carrots->setParent($vegetables);

	// 	$potato = new Category();
	// 	$potato->setTitle('Картофель');
	// 	$potato->setParent($vegetables);

	// 	$em = $this->getDoctrine()->getManager();
	// 	$em->persist($food);
	// 	$em->persist($fruits);
	// 	$em->persist($vegetables);
	// 	$em->persist($carrots);
	// 	$em->persist($potato);
	// 	$em->flush();

	// 	$repo = $em->getRepository('DemosBlogBundle:Category');
	// 	$htmlTree = $repo->childrenHierarchy(
	// 	    null, /* starting from root nodes */
	// 	    false, /* true: load all children, false: only direct */
	// 	    array(
	// 	        'decorate' => true,
	// 	        'representationField' => 'slug',
	// 	        'html' => true
	// 	    )
	// 	);
		
	// 	return $this->render('DemosBlogBundle:Default:index.html.twig', array('name' => 'setCategories', 'cat_tree' => $htmlTree));
	// }

	// public function showCategoriesAction()
	// {
	// 	$em = $this->getDoctrine();
	// 	$repo = $em->getRepository('DemosBlogBundle:Category');
	// 	$htmlTree = $repo->childrenHierarchy(
	// 	    null,
	// 	    false,
	// 	    array(
	// 	        'decorate' => true,
	// 	        'representationField' => 'slug',
	// 	        'html' => true
	// 	    )
	// 	);
	// 	return $this->render('DemosBlogBundle:Default:index.html.twig', array('name' => 'showCategories', 'cat_tree' => $htmlTree));
	// }	

	public function showPostAction($id=NULL)
	{
		$post = $this->getDoctrine()
		    ->getRepository('DemosBlogBundle:Post')
		    ->find($id);

		if (!$post) {
		    throw $this->createNotFoundException('No product found for id '.$id);
		}


		return $this->render('DemosBlogBundle:Default:post.html.twig', array('post' => $post));
	}

	public function showPostsAction()
	{
		$posts = $this->getDoctrine()
		    ->getRepository('DemosBlogBundle:Post')
		    ->findAll();

		if (!$posts) {
		    throw $this->createNotFoundException('No posts found');
		}

		return $this->render('DemosBlogBundle:Default:posts.html.twig', array('posts' => $posts));
	}

	/**
	 * @Route("/testmail", name="demos_blog_mail")
	 */
	public function testMailAction()
	{
		// получаем 'mailer' (обязателен для инициализации Swift Mailer)
		$mailer = $this->get('mailer');

		$sendFrom = 'mail@smf2.lo';
		$sentTo = 'rus-abd@ukr.net';

		$message = \Swift_Message::newInstance()
		    ->setSubject('Проверка работы почтовой системы')
		    ->setFrom($sendFrom)
		    ->setTo($sentTo)
		    ->setBody($this->renderView('DemosBlogBundle:Default:testmailbody.html.twig', array()))
		    ->setContentType('text/html')
		;

		$result = $mailer->send($message);

		return $this->render('DemosBlogBundle:Default:testmail.html.twig', array('mailer' => $mailer, 'mailer_result' => $result));
	}
}

