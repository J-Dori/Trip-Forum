<?php
namespace App\Controller;

use App\Service\AbstractController;
use App\Model\Manager\SubjectManager;
use App\Model\Manager\CategoryManager;


class SubjectController extends AbstractController
{
    public function __construct()
    {
        $this->subjectManager = new SubjectManager();
        $this->categoryManager = new CategoryManager();
    }
    
    public function index(): array
    {
        return $this->render("home/home.php");
    }

    public function listSubject($id): array
    {
        $subject = $this->subjectManager->findAllByCategory($id);
        $countries = $this->categoryManager->findOneById($id); //category
        return $this->render ("subject/subject.php", 
            ["subject" => $subject, "countries" => $countries]
        );
    }

}