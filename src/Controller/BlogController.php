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
     * @Route("/blog/{slug}", requirements={"slug"="[a-z{0-9}-]+"}, name="blog_show")
     * @param $slug
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show($slug = 'Article Sans Titre')
    {
        $slug = ucwords(str_replace("-", " ", $slug));
        return $this->render('blog/article.html.twig', ['slug' => $slug]);
    }

    /**
     * @Route("/artcat", name="blog_index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $category = new Category();
        $repository = $this->getDoctrine()->getRepository(Category::class);
        $categories = $repository->findAll();
        $articles = $category->getArticles();
        return $this->render('blog/index.html.twig', ['categories' => $categories, 'articles' => $articles]);
    }
}