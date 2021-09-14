<?php
namespace App\Model\Manager;

use App\Service\AbstractManager;

class ThemeManager extends AbstractManager
{
    const CLASS_NAME = "App\Model\Entity\Theme";

    public function findAll()
    {
        return $this->getResults(
            self::CLASS_NAME,
            "SELECT id, title, createdAt, country_id, image
             FROM theme
             ORDER BY title"
        );
    }

    public function findOneById($id)
    {
        return $this->getOneOrNullResult(
            self::CLASS_NAME,
            "SELECT id, title, createdAt, country_id, image
             FROM theme
             WHERE id = :id",
            [":id" => $id]
        );
    }

    public function listThemesByCountry($id)
    {
        return $this->getResults(
            self::CLASS_NAME,
            "SELECT id, title, country_id, image
            FROM theme
            WHERE country_id = :id",
            [":id" => $id]
        );
    }

    public function pathCountry($id)
    {
        return $this->getOneOrNullResult(
            self::CLASS_NAME,
            "SELECT title, continent_id, image
             FROM country
             WHERE id = :id",
            [":id" => $id]
        );
    }

}