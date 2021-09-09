<?php
namespace App\Controller;

use App\Service\AbstractController;
use App\Model\Manager\ContinentManager;
use App\Model\Manager\CountryManager;

class CountryController extends AbstractController
{
    public function __construct()
    {
        $this->continentManager = new ContinentManager();
        $this->countryManager = new CountryManager();
    }
    
    public function index(): array
    {
        return $this->render("home/home.php");
    }

    public function listCountry($id): array
    {
        $country = $this->countryManager->findAllByContinent($id);
        $continent = $this->continentManager->findOneById($id);
        return $this->render ("country/country.php", 
            ["country" => $country, "continent" => $continent]
        );
    }

}