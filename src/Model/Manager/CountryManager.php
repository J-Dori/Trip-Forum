<?php
namespace App\Model\Manager;

use App\Service\AbstractManager;

class CountryManager extends AbstractManager
{
    const CLASS_NAME = "App\Model\Entity\Country";

    public function findAll()
    {
        return $this->getResults(
            self::CLASS_NAME,
            "SELECT id, title, createdAt, continent_id
             FROM country
             ORDER BY id"
        );
    }

    public function findOneById($id)
    {
        return $this->getOneOrNullResult(
            self::CLASS_NAME,
            "SELECT id, title, createdAt, continent_id
             FROM country
             WHERE id = :id",
            [":id" => $id]
        );
    }

    public function findAllByContinent($id)
    {
        return $this->getResults(
            self::CLASS_NAME,
            "SELECT id, title, createdAt, continent_id
             FROM country
             WHERE continent_id = :id",
            [":id" => $id]
        );
    }

    public function findTitle($id)
    {
        return $this->getOneOrNullValue(
            "SELECT title
             FROM country
             WHERE continent_id = :id",
            [":id" => $id]
        );
    }

}