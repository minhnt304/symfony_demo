<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use App\Entity\Article;
// use symfony\component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class ArticleController extends AbstractController 
{
        /**
        * @Route("/index")
        * @Method({"GET"})
        */
    public function index(): Response
    {
        // $number = random_int(0, 100);

        // return new Response(
        //     '<html><body>Lucky number: '.$number.'</body></html>'
        // );
        $articles = $this->getDoctrine()->getRepository(Article::class)->findAll();
        return $this->render('articles/index.html.twig', array('articles' => $articles));
    }

    /**
     * @Route("/article/{id}", name="article_show")
     */
    public function show($id){
        $article = $this->getDoctrine()->getRepository(Article::class)->find($id);
        return $this->render('articles/show.html.twig', array('article' => $article));
    }

    /**
     * @Route("/article/save")
     */
    public function save(){
        $entityManager = $this->getDoctrine()->getManager();

        $article = new Article();
        $article->setTitle('Article 2');
        $article->setBody('This is the body for Article two');

        $entityManager->persist($article);
        $entityManager->flush();

        return new Response('Save an article with the id of ' . $article->getId());

    }
}