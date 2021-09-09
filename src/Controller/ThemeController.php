<?php
namespace App\Controller;

use App\Service\AbstractController;
use App\Model\Manager\CountryManager;
use App\Model\Manager\ThemeManager;



class ThemeController extends AbstractController
{
    public function __construct()
    {
        $this->countryManager = new CountryManager();
        $this->themeManager = new ThemeManager();

    }
    
    public function index(): array
    {
        return $this->render("home/home.php");
    }

    public function listTheme($id): array
    {
        $theme = $this->themeManager->listThemesByCountry($id);
        $countSubject = $this->themeManager->countSubjectByTheme($id);
        $countries = $this->countryManager->findOneById($id);
        return $this->render ("theme/theme.php", 
            [
                "theme" => $theme, 
                "countSubject" => $countSubject, 
                "countries" => $countries
            ]
        );
    }

}