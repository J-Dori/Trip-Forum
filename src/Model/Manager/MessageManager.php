<?php
namespace App\Model\Manager;

use App\Service\AbstractManager;
use App\Service\Session;

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

    public function listMessageBySubject($id)
    {
        return $this->getResults(
            self::CLASS_NAME,
            "SELECT id, message, createdAt, subject_id, user_id
            FROM message
            WHERE subject_id = :id
            ORDER BY createdAt",
            [":id" => $id]
        );
    }
    
    public function insertMessage($message, $forumPath, $subjectId)
    {
        return $this->executeQuery(
            "INSERT INTO message (message, subject_id, forumPath, user_id)
              VALUES (:message, :subject_id, :forumPath, :user_id)",
            [
                ":message" => $message,
                ":subject_id" => $subjectId,
                ":forumPath" => $forumPath,
                ":user_id" => Session::getUser()->getId()
            ]
        );
    }

    public function deleteMessage($id)
    {
        return $this->executeQuery(
            "DELETE FROM message WHERE id = :id",
            [ ":id" => $id ]
        );
    }

}