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

   
    public function getCreatedAt($format = "d-m-Y H:i")
    {
        return parent::formatDate($this->createdAt);
    }
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
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


    public function getCountThemes()
    {
        return $this->countThemes;
    }
    public function setCountThemes($countThemes)
    {
        $this->countThemes = $countThemes;
    }

}