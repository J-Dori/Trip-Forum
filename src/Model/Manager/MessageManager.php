<?php
namespace App\Model\Manager;

use App\Service\AbstractManager;
use App\Service\Session;

class MessageManager extends AbstractManager
{
    const CLASS_NAME = "App\Model\Entity\Message";
    const CLASS_SUB = "App\Model\Entity\Subject";

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

    public function countMessagesBySubject($id)
    {
        return $this->getResults(
            self::CLASS_SUB,
            "SELECT s.id, COUNT(m.id) AS countMessages, s.theme_id
            FROM subject s
				LEFT JOIN message m ON s.id = m.subject_id 
				LEFT JOIN theme t ON s.theme_id = t.id
            WHERE s.theme_id = :id
            GROUP BY s.id",
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

    public function editMessage($id, $message)
    {
        return $this->executeQuery(
            "UPDATE message 
             SET message = :message WHERE id = :id",
            [ ":id" => $id, ":message" => $message ]
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