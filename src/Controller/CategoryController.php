<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

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
}