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
            "SELECT id, title, createdAt, theme_id, user_id, closed
             FROM subject
             ORDER BY title"
        );
    }

    public function findOneById($id)
    {
        return $this->getOneOrNullResult(
            self::CLASS_NAME,
            "SELECT id, title, createdAt, theme_id, user_id, closed
             FROM subject
             WHERE id = :id",
            [":id" => $id]
        );
    }

    public function listSubjectsByTheme($id)
    {
        return $this->getResults(
            self::CLASS_NAME,
            "SELECT id, title, createdAt, theme_id, user_id, closed
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

    public function findIfTitleExist($title)
    {
        return $this->getOneOrNullValue(
            "SELECT title
             FROM subject
             WHERE title = :title",
            [":title" => $title]
        );
    }

    public function findClosedSubject($id)
    {
        return $this->getOneOrNullValue(
            "SELECT closed
             FROM subject
             WHERE id = :id",
            [":id" => $id]
        );
    }

    public function findUserSubject($id)
    {
        return $this->getOneOrNullValue(
            "SELECT user_id
             FROM subject
             WHERE id = :id",
            [":id" => $id]
        );
    }

//************************ ADD + EDIT + DELETE    
    public function insertSubject($id, $subject)
    {
        $this->executeQuery(
            "INSERT INTO subject (theme_id, title, user_id)
              VALUES (:theme_id, :title, :user_id)",
            [
                ":title" => $subject,
                ":theme_id" => $id,
                ":user_id" => Session::getUser()->getId()
            ]
        );
        return self::$pdo->lastInsertId();
    }

    public function editSubject($id, $title)
    {
        return $this->executeQuery(
            "UPDATE subject 
             SET title = :title WHERE id = :id",
            [ ":id" => $id, ":title" => $title ]
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
    //Deletes all related messages with $this subject
    public function deleteMessages($id)
    {
        return $this->executeQuery(
            "DELETE FROM message WHERE subject_id = :id",
            [ ":id" => $id ]
        );
    }

//************************ CLOSE & REOPEN SUBJECT
    public function closeSubject($id)
    {
        return $this->executeQuery(
            "UPDATE subject 
             SET closed = 0 WHERE id = :id",
            [ ":id" => $id ]
        );
    }

    public function reopenSubject($id)
    {
        return $this->executeQuery(
            "UPDATE subject 
             SET closed = 1 WHERE id = :id",
            [ ":id" => $id ]
        );
    }

}