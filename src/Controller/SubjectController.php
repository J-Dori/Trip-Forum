<?php
namespace App\Controller;

use App\Service\AbstractController;
use App\Service\Session;
use App\Model\Manager\CountryManager;
use App\Model\Manager\ThemeManager;
use App\Model\Manager\SubjectManager;
use App\Model\Manager\MessageManager;



class SubjectController extends AbstractController
{
    public function __construct()
    {
        $this->countryManager = new CountryManager();
        $this->themeManager = new ThemeManager();
        $this->subjectManager = new SubjectManager();
        $this->messageManager = new messageManager();
    }
    
    public function index(): array
    {
        return $this->render("home/home.php");
    }

    public function listSubject($id): array
    {
        $countryId = $_GET["country"];
        $subject = $this->subjectManager->listSubjectsByTheme($id);
        $msgCount = $this->messageManager->countMessagesBySubject($id);


        $countries = $this->countryManager->findOneById($countryId);
        $theme = $this->themeManager->findOneById($id);
        return $this->render ("subject/subject.php", 
            [
                "subject" => $subject,
                "msgCount" => $msgCount,
                "countries" => $countries,
                "theme" => $theme
            ]
        );
    }

    public function postSubject($id)
    {
        $path = Session::getCurrentPath();
        if(!empty($_POST)) {
            if (Session::getUser()){
                $subject = filter_input(INPUT_POST, "subject", FILTER_SANITIZE_STRING);

                if($subject){
                    if (!$this->subjectManager->findIfTitleExist($subject)) {
                        $lastID = $this->subjectManager->insertSubject($id, $subject);

                        $getPathCtrl = Session::getBetween($path, "ctrl=", "&id");
                        $setPathCtrl = str_replace($getPathCtrl, "message&action=listMessage", $path);
                        $getPathID = Session::getBetween($setPathCtrl, "listMessage&", "&country");
                        $setPath = str_replace($getPathID, "id=$lastID", $setPathCtrl);
                        $this->redirectTo("$setPath");
                    }
                    else
                        $this->addFlash("error", "The subject title already exists!<br>Please, insert a new Title.");
                }
            }
            else {
                $this->addFlash("error", "You do not have access to this function !");
            }
        }

        return $this->redirectTo("$path");
    }

    public function editSubject($id)
    {
        if(!empty($_POST)) 
        {
            if (!Session::isAnonymous())
            {
                $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_STRING);
                $id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);

                
                if($title)
                {
                    if (!$this->subjectManager->findIfTitleExist($title))
                    {
                        $this->subjectManager->editSubject($id, $title);
                        Session::setMessage("success", "Subject created successfully!<br>Please add the first message...");
                    }
                    else
                        $this->addFlash("error", "The subject title already exists!<br>Please, insert a new Title.");
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