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
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category/{id}", name="category_show")
     * @param Category $category
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show(Category $category) :Response
    {
        return $this->render('blog/category.html.twig', ['category'=>$category]);
    }
}