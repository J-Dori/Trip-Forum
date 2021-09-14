<?php
namespace App\Model\Entity;

use App\Service\AbstractEntity;

class Theme extends AbstractEntity 
{
    private $id;
    private $title;
    private $createdAt;
    private $country;
    private $image;

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


    public function getCountry()
    {
        return $this->country;
    }
    public function setCountry($country)
    {
        $this->country = $country;
    }


    public function getImage()
    {
        return $this->image;
    }
    public function setImage($image)
    {
        $this->image = $image;
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