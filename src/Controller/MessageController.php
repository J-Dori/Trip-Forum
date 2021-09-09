<?php
namespace App\Controller;

use App\Service\AbstractController;
use App\Model\Manager\CountryManager;
use App\Model\Manager\ThemeManager;
use App\Model\Manager\SubjectManager;
use App\Model\Manager\MessageManager;


class MessageController extends AbstractController
{
    public function __construct()
    {
        $this->countryManager = new CountryManager(); //get Path "continent / country"
        $this->themeManager = new ThemeManager(); //get Path "... / ... / theme"
        $this->subjectManager = new SubjectManager();
        $this->messageManager = new MessageManager();
    }
    
    public function index(): array
    {
        return $this->render("home/home.php");
    }

    public function listMessage($id): array
    {
        $countryId = $_GET["country"];
        $themeId = $_GET["theme"];
        $message = $this->messageManager->listMessageBySubject($id);
        $subject = $this->subjectManager->findOneById($id);
        $countries = $this->countryManager->findOneById($countryId);
        $theme = $this->themeManager->findOneById($themeId);
        return $this->render ("message/message.php", 
            [
                "message" => $message,  
                "countries" => $countries,
                "theme" => $theme,
                "subject" => $subject
            ]
        );
    }

}