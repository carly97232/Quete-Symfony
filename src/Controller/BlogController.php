<?php
/**
 * Created by PhpStorm.
 * User: jovanela
 * Date: 04/11/18
 * Time: 20:51
 */
namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleSearchType;
use App\Form\ArticleType;
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
        return $this->render('blog/tag.html.twig', ['page' => $page]);
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
     * Show all row from article's entity
     *
     * @Route("/allarticles", name="blog_index")
     * @param Request $request
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
        $form = $this->createForm(
            ArticleSearchType::class,
            null,
            ['method' => Request::METHOD_GET]
        );
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();
            return $this -> redirectToRoute('blog_index');
        }
        return $this->render(
            'blog/index.html.twig',
            [
                'articles' => $articles,
                'form' => $form->createView(),
            ]
        );
    }
}
