<?php
namespace App\Service;


use App\Service\AbstractController;
use App\Service\Session;
use App\Model\Manager\ContinentManager;
use App\Model\Manager\CountryManager;
use App\Model\Manager\ThemeManager;
use App\Model\Manager\SubjectManager;
use App\Model\Manager\MessageManager;

class Path extends AbstractController
{
    public function __construct()
    {
        $this->continent = new ContinentManager(); 
        $this->country = new CountryManager(); 
        $this->theme = new ThemeManager();
        $this->subject = new SubjectManager();
        $this->message = new MessageManager();
    }

    public function index(): array
    {
        return $this->render("home/home.php");
    }

    public static function getCurrentURL()
    {
        if (isset($_SESSION["url"])) {
            $url = $_SESSION["url"];
            unset($_SESSION["url"]);
            return $url;
        }
        return null;
    }

    public static function setCurrentURL() :void
    {
        unset($_SESSION["url"]);
        $string = $_SERVER["REQUEST_URI"];
        $prefix = "index.php?ctrl=";
        $index = strpos($string, $prefix) + strlen($prefix);
        $curURL = substr($string, $index);

        if ($curURL == "") 
            $curURL = "index.php";

        $_SESSION['url'] = $curURL;
    }

    
    public function setContinent() :void
    {
        //$id = $this->continent->getId();
        $title = $this->continent->getTitle();
        $_SESSION['path'] = "$title";
    }
    
    public function setCountry() :void
    {
        //$id = $this->Country->getId();
        $title = $this->country->getTitle();
        $_SESSION['path'] .= " / $title";
    }
    
    public function setTheme() :void
    {
        //$id = $this->theme->getId();
        $title = $this->theme->getTitle();
        $_SESSION['path'] .= " / $title";
    }
    
    public function setSubject() :void
    {
        //$id = $this->subject->getId();
        $title = $this->continent->getTitle();
        $_SESSION['path'] .= " / $title";
    }

    

}