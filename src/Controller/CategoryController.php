<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class CategoryController extends AbstractController{

    /**
     * @Route ("/category/list", name="category_list")
     */

    public function categorylist(CategoryRepository $categoryRepository){
        $result = $categoryRepository->findAll();

        return $this->render('listcategory.html.twig',
            [
                'result'=>$result
            ]);
    }

    /**
     * @Route ("/category/show/{id}", name="category_show")
     */

    public function categoryShow($id, CategoryRepository $categoryRepository){
        $result4category = $categoryRepository->find($id);

        return $this->render('category.html.twig',
            [
                'result4category'=>$result4category
            ]);
    }

    /**
     * @Route ("/category/insert-static", name="category_insert_static")
     */

    public function insertStaticCategory (EntityManagerInterface $entitymanager) {
        $category = new Category();

        $category->setTitle('Titre de mon article');
        $category->setColor('couleur de mon article');
        $category->setDatecreation(new \DateTime(2020-12-31));
        $category->setDatepublication(new \DateTime(2020-12-31));
        $category->setPublished(true);

        $entitymanager->persist($category);
        $entitymanager->flush();

        return $this->render('category_insert_static.html.twig',
        [
            'category'=>$category
        ]);
    }
}