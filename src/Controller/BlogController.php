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
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class BlogController extends AbstractController
{
    /**
     * @Route("/category/{category}", name="blog_show_category")
     * @param string $category
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showByCategory(string $category): Response
    {
        $repository = $this->getDoctrine()->getRepository(Category::class);
        $category = $repository->findOneBy(['name'=>$category]);
        $repository = $this->getDoctrine()->getRepository(Article::class);
        $articles = $repository->findBy(
            ['category'=> $category],
            ['id'=>'DESC'],
            3
        );
        return $this->render(
            'blog/category2.html.twig',
            ['category' => $category, 'articles'=> $articles]
        );
    }

    /**
     * Show all row from article's entity
     *
     * @Route("/articles", name="blog_index")
     * @return Response A response instance
     */
    public function index(Request $request) : Response
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
                'articles' => $articles,
            ]
        );
    }
}