<?php
namespace App\Model\Manager;

use App\Service\AbstractManager;

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

}