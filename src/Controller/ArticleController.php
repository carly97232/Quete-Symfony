<?php
/**
 * Created by PhpStorm.
 * User: jovanela
 * Date: 08/11/18
 * Time: 16:22
 */

namespace App\Controller;


use App\Entity\Article;
use App\Entity\Category;
use App\Form\ArticleType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article/{id}", name="article_show")
     * @param Article $article
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show(Article $article) :Response
    {

        return $this->render('article.html.twig', ['article'=>$article]);
    }

    /**
     * Show all row from article's entity
     *
     * @Route("/article", name="blog_article_index")
     * @param Request $request
     * @return Response A response instance
     */
    public function index(Request $request) : Response
    {
        $article = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findAll();
        if (!$article) {
            throw $this->createNotFoundException(
                'No article found in article\'s table.'
            );
        }
        $form = $this->createForm(
            ArticleType::class,
            $article,
            ['method' => Request::METHOD_POST]
        );

        return $this->render(
            'blog/article.html.twig', [
                'articles' => $article,
            ]
        );
    }
}