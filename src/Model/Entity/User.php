<?php
namespace App\Model\Entity;

use App\Service\AbstractEntity;

class User extends AbstractEntity 
{
    private $id;
    private $username;
    private $email;
    private $password;
    private $createdAt;
    private $avatar;
    private $role;

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


    public function getUsername()
    {
        return $this->username;
    }
    public function setUsername($username)
    {
        $this->username = $username;
    }


    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }


    public function getPassword()
    {
        return $this->password;
    }
    public function setPassword($password)
    {
        $this->password = $password;
    }


    public function getCreatedAt($format = "d-m-Y H:i")
    {
        return parent::formatDate($this->createdAt);
    }
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }


    public function getAvatar()
    {
        return $this->avatar;
    }
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
    }


    public function getRole()
    {
        return $this->role;
    }
    public function setRole($role)
    {
        $this->role = $role;
    }
}
