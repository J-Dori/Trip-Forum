<?php
namespace App\Controller;

use App\Service\AbstractController;
use App\Model\Manager\ContinentManager;

class HomeController extends AbstractController
{
    public function __construct()
    {
        $this->continentManager = new ContinentManager();
    }
    
    public function index(): array
    {
        return $this->listContinent();
    }

    public function listContinent(): array
    {
        $continent = $this->continentManager->findAll();
        return $this->render ("home/home.php", ["continent" => $continent]);
    }

}