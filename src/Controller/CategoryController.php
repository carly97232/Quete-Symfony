<?php
/**
 * Created by PhpStorm.
 * User: jovanela
 * Date: 08/11/18
 * Time: 16:22
 */
namespace App\Controller;

use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class CategoryController extends AbstractController
{

    /**
     * Show all row from category's entity
     *
     * @Route("/category", name="blog_category_index")
     * @return Response A response instance
     */
    public function index(Request $request) : Response
    {
        $category = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();
        if (!$category) {
            throw $this->createNotFoundException(
                'No category found in category\'s table.'
            );
        }
        return $this->render(
            'blog/category.html.twig', [
                'categories' => $category,
            ]
        );
    }
}