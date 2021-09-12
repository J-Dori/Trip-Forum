<?php
namespace App\Controller;

use App\Service\AbstractController;
use App\Service\Session;
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

    public function postSubject($id)
    {
        $themeId = $_GET["theme"];
        if(!empty($_POST)) {
            if (Session::isRoleUser("ROLE_ADMIN")){
                $subject = filter_input(INPUT_POST, "subject", FILTER_SANITIZE_STRING);

                if($subject){
                    $this->subjectManager->insertSubject($id, $subject);
                }
            }
            else {
                $this->addFlash("error", "You do not have access to this function !");
            }
        }
        $path = Session::getCurrentPath();
        return $this->redirectTo("$path");
    }

    public function deleteSubject($id)
    {
        if(!($_POST)) {
            if (!Session::isAnonymous()){
                $this->subjectManager->deleteSubject($id);
            }
            else {
                $this->addFlash("error", "You do not have access to this function !");
            }
        }
        $path = Session::getCurrentPath();
        return $this->redirectTo("$path");
        
    }

}