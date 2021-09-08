<?php
namespace App\Model\Manager;

use App\Service\AbstractManager;

class CategoryManager extends AbstractManager
{
    const CLASS_NAME = "App\Model\Entity\Category";

    public function findAll()
    {
        return $this->getResults(
            self::CLASS_NAME,
            "SELECT id, title, createdAt, continent_id
             FROM category
             ORDER BY id"
        );
    }

    public function findOneById($id)
    {
        return $this->getOneOrNullResult(
            self::CLASS_NAME,
            "SELECT id, title, createdAt, continent_id
             FROM category
             WHERE id = :id",
            [":id" => $id]
        );
    }

    public function findAllByContinent($id)
    {
        return $this->getResults(
            self::CLASS_NAME,
            "SELECT id, title, createdAt, continent_id
             FROM category
             WHERE continent_id = :id",
            [":id" => $id]
        );
    }

    public function findTitle($id)
    {
        return $this->getOneOrNullValue(
            "SELECT title
             FROM category
             WHERE continent_id = :id",
            [":id" => $id]
        );
    }

}