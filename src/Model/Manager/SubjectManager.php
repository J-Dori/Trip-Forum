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
            "SELECT id, title, createdAt, category_id, user_id
             FROM subject
             ORDER BY createdAt DESC"
        );
    }

    public function findOneById($id)
    {
        return $this->getOneOrNullResult(
            self::CLASS_NAME,
            "SELECT id, title, createdAt, category_id, user_id
             FROM subject
             WHERE id = :id",
            [":id" => $id]
        );
    }

    public function findAllByCategory($id)
    {
        return $this->getResults(
            self::CLASS_NAME,
            "SELECT id, title, createdAt, category_id, user_id
             FROM subject
             WHERE category_id = :id",
            [":id" => $id]
        );
    }

}