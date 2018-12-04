<?php

namespace App\Controller;

use App\Entity\Tag;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TagController extends AbstractController
{
    /**
     * @Route("/tags", name="tag_index")
     */
    public function index()
    {
        $tags = $this->getDoctrine()->getRepository(Tag::class);
        $tags = $tags->findAll();
        return $this->render('tag/index.html.twig', [
            'tags' => $tags,
        ]);
    }

    /**
     * @Route("/tag/{name}", name="tag_show")
     * @param Tag $tag
     * @return Response
     */
    public function show(Tag $tag) :Response
    {
        return $this->render('tag/tag.html.twig', ['tag' =>$tag]);
    }
}
