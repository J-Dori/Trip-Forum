<?php
namespace App\Model\Entity;

use App\Service\AbstractEntity;

class Country extends AbstractEntity 
{
    private $id;
    private $title;
    private $createdAt;
    private $continent;

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


    public function getContinent()
    {
        return $this->continent;
    }
    public function setContinent($continent)
    {
        $this->continent = $continent;
    }
}