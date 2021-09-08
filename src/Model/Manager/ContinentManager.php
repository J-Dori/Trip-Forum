<?php
namespace App\Model\Manager;

use App\Service\AbstractManager;

class ContinentManager extends AbstractManager
{
    const CLASS_NAME = "App\Model\Entity\Continent";

    public function findAll()
    {
        return $this->getResults(
            self::CLASS_NAME,
            "SELECT id, title
             FROM continent
             ORDER BY id"
        );
    }

    public function findOneById($id)
    {
        return $this->getOneOrNullResult(
            self::CLASS_NAME,
            "SELECT id, title
             FROM continent
             WHERE id = :id",
            [":id" => $id]
        );
    }

    public function findTitle($id)
    {
        return $this->getOneOrNullValue(
            "SELECT title
             FROM continent
             WHERE id = :id",
            [":id" => $id]
        );
    }

}