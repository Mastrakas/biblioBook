<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
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
     * @Route ("/article/show/{id}", name="article_show")
     */

    public function articleShow($id, ArticleRepository $articleRepository){
        $result4article = $articleRepository->find($id);

        return $this->render('article.html.twig',
        [
            'result4article'=>$result4article
        ]);
    }

    /**
     * @Route ("/article/insert-static", name="article_insert_static")
     */

    public function insertStaticArticle (EntityManagerInterface $entitymanager) {
        $article = new Article();

        $article->setTitle('Titre de mon article');
        $article->setContent('contenu de mon article');
        $article->setImage('image de mon article');
        $article->setDatecreation(new \DateTime(2020-12-31));
        $article->setDatepublication(new \DateTime(2020-12-31));
        $article->setPublished(true);

        $entitymanager->persist($article);
        $entitymanager->flush();

        return $this->render('article_insert_static.html.twig');
    }

    /**
     *@Route ("/article/update-static/{id}", name="article_update_static")
     */

    public function updateStaticArticle ($id, EntityManagerInterface $entitymanager, ArticleRepository $articleRepository) {
        $article = $articleRepository->find($id);
        $article->setTitle("ça c'est le bon titre !");

        $entitymanager->persist($article);
        $entitymanager->flush();

        return $this->render('article_update_static.html.twig');
    }

    /**
     * @Route ("/article/delete/{id}", name="delete_article")
     */
    public function deleteArticle ($id, ArticleRepository $articleRepository, EntityManagerInterface $entitymanager) {
        $article = $articleRepository->find($id);

        if (!is_null($article)) {
            $entitymanager->remove($article);
            $entitymanager->flush();
        }

        return $this->render('article_delete.html.twig');
    }
}