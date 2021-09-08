<?php
namespace App\Model\Manager;

use App\Service\AbstractManager;

class MessageManager extends AbstractManager
{
    const CLASS_NAME = "App\Model\Entity\Message";

    public function findAll()
    {
        return $this->getResults(
            self::CLASS_NAME,
            "SELECT id, message, createdAt, subject_id, user_id
             FROM message
             ORDER BY createdAt DESC"
        );
    }

    public function findOneById($id)
    {
        return $this->getOneOrNullResult(
            self::CLASS_NAME,
            "SELECT id, message, createdAt, subject_id, user_id
             FROM message
             WHERE id = :id",
            [":id" => $id]
        );
    }

    public function findAllBySubject($id)
    {
        return $this->getResults(
            self::CLASS_NAME,
            "SELECT id, message, createdAt, subject_id, user_id
             FROM message
             WHERE subject_id = :id",
            [":id" => $id]
        );
    }

}