<?php
/**
 * Created by PhpStorm.
 * User: jovanela
 * Date: 04/11/18
 * Time: 20:51
 */

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Category;
use App\Form\ArticleSearchType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog/{page}", requirements={"page"="\d+"}, name="blog_list")
     * @param $page
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function list($page)
    {
        return $this->render('blog/index.html.twig', ['page' => $page]);
    }

    /**
     * Show all row from article's entity
     *
     * @Route("/", name="blog_index")
     * @return Response A response instance
     */
    public function index() : Response
    {
        $articles = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findAll();

        if (!$articles) {
            throw $this->createNotFoundException(
                'No article found in article\'s table.'
            );
        }

        return $this->render(
            'blog/index.html.twig', [
                'articles' => $articles
            ]
        );
    }

    /**
     * Getting a article with a formatted slug for title
     *
     * @param string $slug The slugger
     *
     * @Route("/{slug<^[a-z0-9-]+$>}",
     *     defaults={"slug" = null},
     *     name="blog_show")
     *  @return Response A response instance
     */
    public function show($slug) : Response
    {
        if (!$slug) {
            throw $this
                ->createNotFoundException('No slug has been sent to find an article in article\'s table.');
        }

        $slug = preg_replace(
            '/-/',
            ' ', ucwords(trim(strip_tags($slug)), "-")
        );

        $article = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findOneBy(['title' => mb_strtolower($slug)]);

        if (!$article) {
            throw $this->createNotFoundException(
                'No article with '.$slug.' title, found in article\'s table.'
            );
        }

        return $this->render(
            'blog/show.html.twig',
            [
                'article' => $article,
                'slug' => $slug,
            ]
        );
    }

    /**
     * @param string $category
     * @return Response
     * @Route("/category/{category}", name="blog_show_category")
     */
    public function showByCategory(string $category)
    {

    }
}