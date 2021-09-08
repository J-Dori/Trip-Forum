<?php
namespace App\Model\Entity;

use App\Service\AbstractEntity;

class Message extends AbstractEntity 
{
    private $id;
    private $message;
    private $createdAt;
    private $subject;
    private $user;

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

    
    public function getMessage()
    {
        return $this->message;
    }
    public function setMessage($message)
    {
        $this->message = $message;
    }

   
    public function getCreatedAt($format = "d-m-Y H:i")
    {
        return parent::formatDate($this->createdAt);
    }
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }


    public function getSubject()
    {
        return $this->subject;
    }
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }


    public function getUser()
    {
        return $this->user;
    }
    public function setUser($user)
    {
        $this->user = $user;
    }
}