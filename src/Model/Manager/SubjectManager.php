<?php
namespace App\Model\Manager;

use App\Service\AbstractManager;
use App\Service\Session;

class SubjectManager extends AbstractManager
{
    const CLASS_NAME = "App\Model\Entity\Subject";

    public function findAll()
    {
        return $this->getResults(
            self::CLASS_NAME,
            "SELECT id, title, createdAt, theme_id, user_id
             FROM subject
             ORDER BY title"
        );
    }

    public function findOneById($id)
    {
        return $this->getOneOrNullResult(
            self::CLASS_NAME,
            "SELECT id, title, createdAt, theme_id, user_id
             FROM subject
             WHERE id = :id",
            [":id" => $id]
        );
    }

    public function listSubjectsByTheme($id)
    {
        return $this->getResults(
            self::CLASS_NAME,
            "SELECT id, title, createdAt, theme_id, user_id
            FROM subject
            WHERE theme_id = :id",
            [":id" => $id]
        );
    }

    public function findTitle($id)
    {
        return $this->getOneOrNullValue(
            "SELECT title
             FROM subject
             WHERE id = :id",
            [":id" => $id]
        );
    }

    /* public function countMessagesBySubject($id)
    {
        return $this->getOneOrNullResult(
            self::CLASS_NAME,
            "SELECT COUNT(subject_id) AS countMessages
             FROM messages
             WHERE subject_id = :id",
            [":id" => $id]
        );
    } */

    
    public function insertSubject($id, $subject)
    {
        return $this->executeQuery(
            "INSERT INTO subject (theme_id, title, user_id)
              VALUES (:theme_id, :title, :user_id)",
            [
                ":title" => $subject,
                ":theme_id" => $id,
                ":user_id" => Session::getUser()->getId()
            ]
        );
    }

    public function deleteSubject($id)
    {
        $this->deleteMessages($id);
        return $this->executeQuery(
            "DELETE FROM subject WHERE id = :id",
            [ ":id" => $id ]
        );
    }

    public function deleteMessages($id)
    {
        return $this->executeQuery(
            "DELETE FROM message WHERE subject_id = :id",
            [ ":id" => $id ]
        );
    }

}