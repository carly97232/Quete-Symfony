<?php
/**
 * Created by PhpStorm.
 * User: jovanela
 * Date: 04/11/18
 * Time: 21:07
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/author", name="author_")
 */
class AuthorController extends AbstractController
{
    /**
     * Correspond à la route /author/list et au name "author_list"
     * @Route("/list", name="list")
     */
    public function list()
    {
        // ...
    }

    /**
     * Correspond à la route /author/new et au name "author_new"
     * @Route("/new", name="new")
     */
    public function new()
    {
        // traitement d'un formulaire par exemple

        // redirection vers la page 'blog_list', correspondant à l'url /blog/5
        return $this->redirectToRoute('blog_list', ['page'=>5]);
    }
}