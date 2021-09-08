<?php
namespace App\Controller;

use App\Service\AbstractController;
use App\Model\Manager\CategoryManager;
use App\Model\Manager\SubjectManager;
use App\Model\Manager\MessageManager;


class MessageController extends AbstractController
{
    public function __construct()
    {
        $this->categoryManager = new CategoryManager();
        $this->subjectManager = new SubjectManager();
        $this->messageManager = new MessageManager();
    }
    
    public function index(): array
    {
        return $this->render("home/home.php");
    }

    public function listMessage($id): array
    {
        $message = $this->messageManager->findAllBySubject($id);
        $countries = $this->categoryManager->findOneById($id); //category
        $subject = $this->subjectManager->findOneById($id); //category
        return $this->render ("message/message.php", 
            [
                "message" => $message, 
                "countries" => $countries, 
                "subject" => $subject]
        );
    }

}