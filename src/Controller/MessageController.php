<?php
namespace App\Controller;

use App\Service\AbstractController;
use App\Service\Session;
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

    public function OpenEditMessage($id): array
    {
        $countryId = $_GET["country"];
        $themeId = $_GET["theme"];
        $subjectId = $_GET["subject"];
        $message = $this->messageManager->findOneById($id);
        $subject = $this->subjectManager->findOneById($subjectId);
        $countries = $this->countryManager->findOneById($countryId);
        $theme = $this->themeManager->findOneById($themeId);
        return $this->render ("message/editMessage.php", 
            [
                "message" => $message,  
                "countries" => $countries,
                "theme" => $theme,
                "subject" => $subject
            ]
        );
    }

/************************ ADD + EDIT + DELETE */
    public function postMessage($subjectId)
    {
        if(!empty($_POST)) {
            if (!Session::isAnonymous()){
                $message = filter_input(INPUT_POST, "message", FILTER_SANITIZE_STRING);
                    $message = str_replace("\n", "<br>", $message);
                $forumPath = filter_input(INPUT_POST, "forumPath", FILTER_SANITIZE_STRING);

                if($message && $forumPath){
                     $this->messageManager->insertMessage($message, $forumPath, $subjectId);
                }
            }
            else {
                $this->addFlash("error", "You do not have access to this function !");
            }
        }
        $path = Session::getCurrentPath();
        return $this->redirectTo("$path");
    }

    public function editMessage($id)
    {
        if(!empty($_POST)) {
            if (!Session::isAnonymous()){
                $message = filter_input(INPUT_POST, "message", FILTER_SANITIZE_STRING);
                $message = str_replace("\n", "<br>", $message);

                if($message){
                    $this->messageManager->editMessage($id, $message);
                }
            }
            else {
                $this->addFlash("error", "You do not have access to this function !");
            }
        }
        $path = Session::getCurrentPath();
        return $this->redirectTo("$path");
        
    }

    public function deleteMessage($id)
    {
        if(($_POST)) {
            if (!Session::isAnonymous()){
                $this->messageManager->deleteMessage($id);
            }
            else {
                $this->addFlash("error", "You do not have access to this function !");
            }
        }
        $path = Session::getCurrentPath();
        return $this->redirectTo("$path");
        
    }

    //REOPEN SUBJECT
    public function closeSubject($id)
    {
        if(!($_POST)) {
            if (!Session::isAnonymous()){
                if (Session::getUser()->getId() == $this->subjectManager->findUserSubject($id) || Session::getUser()->getRole() != "USER")
                $this->subjectManager->closeSubject($id);
            }
            else {
                $this->addFlash("error", "You do not have access to this function !");
            }
        }
        $path = Session::getCurrentPath();
        return $this->redirectTo("$path");  
    }

    public function reopenSubject($id)
    {
        if(!($_POST)) {
            if (!Session::isAnonymous()){
                if (Session::getUser()->getId() == $this->subjectManager->findUserSubject($id) || Session::getUser()->getRole() != "USER")
                $this->subjectManager->reopenSubject($id);
            }
            else {
                $this->addFlash("error", "You do not have access to this function !");
            }
        }
        $path = Session::getCurrentPath();
        return $this->redirectTo("$path");  
    }

}