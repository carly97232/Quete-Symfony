<?php
/**
 * Created by PhpStorm.
 * User: jovanela
 * Date: 29/10/18
 * Time: 13:36
 */
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route ("/", name="Hello")
     * @Route("/",name="homepage")
     */
    public function index()
    {
        return $this->render('Home.html.twig');
    }
}