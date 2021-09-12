<?php
namespace App\Model\Manager;

use App\Service\AbstractManager;

class UserManager extends AbstractManager
{
    const CLASS_NAME = "App\Model\Entity\User";
    const ALL_FIELDS = "id, username, email, createdAt, avatar, role";

    public function findAll()
    {
        return $this->getResults(
            self::CLASS_NAME,
            "SELECT ". self::ALL_FIELDS ."
             FROM user"
        );
    }

    public function findOneById($id)
    {
        return $this->getOneOrNullResult(
            self::CLASS_NAME,
            "SELECT id, username, email, createdAt, avatar, role
             FROM user
             WHERE id = :id",
            [":id" => $id]
        );
    }

    public function findUserByEmail($email)
    {
        return $this->getOneOrNullResult(
            self::CLASS_NAME,
            "SELECT id, username, email, createdAt, avatar, role FROM user WHERE email = :email",
            [":email" => $email]
        );
    }

    public function findPasswordByEmail($email)
    {
        return $this->getOneOrNullValue(
            "SELECT password FROM user WHERE email = :email",
            [":email" => $email]
        );
    }

    public function verifyUser($email, $username)
    {
        $email = strtolower($email);
        $username = strtolower($username);

        return $this->getOneOrNullResult(
            self::CLASS_NAME,
            "SELECT id, username, email, createdAt, avatar, role FROM user WHERE LOWER(email) = :email OR LOWER(username) = :username",
            [":email" => $email, ":username" => $username]
        );
    }

    public function insertUser($email, $username, $password)
    {
        return $this->executeQuery(
            "INSERT INTO user (username, email, password)
            VALUES (:username, :email, :password)",
            [
                ":email" => $email, 
                ":username" => $username, 
                ":password" => $password
            ]
        );
    }

    public function updatePassword($email, $hash) {
       return $this->executeQuery(
            "UPDATE user SET password = :hash
            WHERE email = :email",
            [
                ":email" => $email, 
                ":hash" => $hash
            ]
        );
    }

    public function updateAvatarImg($id, $updFile)
    {
        return $this->executeQuery(
            "UPDATE user SET avatar = :updFile WHERE id = :id",
            [
                ":id" => $id, 
                ":updFile" => $updFile
            ]
        );
    }

    
    public function profileList10LastMessages($id)
    {
        return $this->getResults(
            "App\Model\Entity\Message",
            "SELECT * FROM message WHERE user_id = :id",
            [":id" => $id]
        );
    }

}