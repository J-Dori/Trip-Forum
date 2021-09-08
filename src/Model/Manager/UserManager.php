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
            "SELECT id, username, email FROM user WHERE email = :email",
            [":email" => $email]
        );
    }

    public function findPasswordByEmail($id)
    {
        return $this->getOneOrNullResult(
            self::CLASS_NAME,
            "SELECT password FROM user WHERE id = :id",
            [":id" => $id]
        );
    }

    public function verifyUser($email, $username)
    {
        $email = strtolower($email);
        $username = strtolower($username);

        return $this->getOneOrNullResult(
            self::CLASS_NAME,
            "SELECT * FROM user WHERE LOWER(email) = :email OR LOWER(username) = :username",
            [":email" => $email, ":username" => $username]
        );
    }

    public function insertUser($email, $username, $password)
    {
        return $this->executeQuery(
            self::CLASS_NAME,
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
            self::CLASS_NAME,
            "UPDATE user SET password = :hash
            WHERE email = :email",
            [
                ":email" => $email, 
                ":hash" => $hash
            ]
        );
    }

    /* PROFILE */
    /* public function findUserProfile($id)
    {
        return $this->getOneOrNullResult(
            self::CLASS_NAME,
            "SELECT username, email, avatar FROM user WHERE id = :id",
            [":id" => $id]
        );
    } */

}