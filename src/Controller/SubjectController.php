<?php
namespace App\Controller;

use App\Service\AbstractController;
use App\Model\Manager\CountryManager;
use App\Model\Manager\ThemeManager;
use App\Model\Manager\SubjectManager;



class SubjectController extends AbstractController
{
    public function __construct()
    {
        $this->countryManager = new CountryManager();
        $this->themeManager = new ThemeManager();
        $this->subjectManager = new SubjectManager();

    }
    
    public function index(): array
    {
        return $this->render("home/home.php");
    }

    public function listSubject($id): array
    {
        $countryId = $_GET["country"];
        $subject = $this->subjectManager->listSubjectsByTheme($id);
        $countries = $this->countryManager->findOneById($countryId);
        $theme = $this->themeManager->findOneById($id);
        return $this->render ("subject/subject.php", 
            [
                "subject" => $subject,  
                "countries" => $countries,
                "theme" => $theme
            ]
        );
    }

}