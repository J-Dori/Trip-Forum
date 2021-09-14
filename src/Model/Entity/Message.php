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
    private $forumPath;
    
    private $countMessages;

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

   
    public function getCreatedAt($format = "d/m/Y - H:i")
    {
        return $this->createdAt->format($format);
    }
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = new \DateTime($createdAt);
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


    public function getCountMessages()
    {
        return $this->countMessages;
    }
    public function setCountMessages($countMessages)
    {
        $this->countMessages = $countMessages;
    }


    public function getForumPath()
    {
        return $this->forumPath;
    }
    public function setForumPath($forumPath)
    {
        $this->forumPath = $forumPath;
    }

}