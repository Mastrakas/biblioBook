<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController{

    /**
     * @Route ("/article/list", name="article_list")
     */

    public function articlelist(ArticleRepository $articleRepository){
        $result = $articleRepository->findAll();

        return $this->render('listarticle.html.twig',
        [
            'result'=>$result
        ]);
    }

    /**
     * @Route ("/article/{id}", name="article_show")
     */

    public function articleShow($id, ArticleRepository $articleRepository){
        $result2 = $articleRepository->find($id);

        return $this->render('article.html.twig',
        [
            'result2'=>$result2
        ]);
    }
}