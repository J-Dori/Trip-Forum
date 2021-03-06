<?php
namespace App\Model\Entity;

use App\Service\AbstractEntity;

class Subject extends AbstractEntity 
{
    private $id;
    private $title;
    private $createdAt;
    private $theme;
    private $user;
    private $closed = 1; //1=Open * 0=Closed - 

    private $countThemes;



    public function __construct($data)
    {
        parent::hydrate($data, $this);
    }

    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }

    
    public function getTitle()
    {
        return $this->title;
    }
    public function setTitle($title)
    {
        $this->title = $title;
    }

   
    public function getCreatedAt($format = "d/m/Y - H:i")
    {
        return $this->createdAt->format($format);
    }
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = new \DateTime($createdAt);
    }


    public function getTheme()
    {
        return $this->theme;
    }
    public function setTheme($theme)
    {
        $this->theme = $theme;
    }


    public function getUser()
    {
        return $this->user;
    }
    public function setUser($user)
    {
        $this->user = $user;
    }


    public function getClosed()
    {
        return $this->closed;
    }
    public function setClosed($closed)
    {
        $this->closed = $closed;
    }


    public function getCountThemes()
    {
        return $this->countThemes;
    }
    public function setCountThemes($countThemes)
    {
        $this->countThemes = $countThemes;
    }

}