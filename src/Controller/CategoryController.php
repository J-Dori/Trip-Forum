<?php
namespace App\Controller;

use App\Service\AbstractController;
use App\Model\Manager\ContinentManager;
use App\Model\Manager\CategoryManager;

class CategoryController extends AbstractController
{
    public function __construct()
    {
        $this->continentManager = new ContinentManager();
        $this->categoryManager = new CategoryManager();
    }
    
    public function index(): array
    {
        return $this->render("home/home.php");
    }

    public function listCategory($id): array
    {
        $category = $this->categoryManager->findAllByContinent($id);
        $continent = $this->continentManager->findOneById($id);
        return $this->render ("category/category.php", 
            ["category" => $category, "continent" => $continent]
        );
    }

}