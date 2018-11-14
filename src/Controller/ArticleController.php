<?php
/**
 * Created by PhpStorm.
 * User: jovanela
 * Date: 08/11/18
 * Time: 16:22
 */

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
        $articles = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findAll();
        return $this->render('article.html.twig', ['articles'=>$articles]);
    }
}