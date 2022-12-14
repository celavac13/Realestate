<?php

namespace App\Models;

use PDO;

class City extends Model
{
    protected int $id;
    protected string $name;
    protected string $slug;
    protected static string $table = "cities";

    public function __construct(array $data = [])
    {
        if (isset($data['id'])) {
            $this->id = $data['id'];
        }

        if (isset($data['name'])) {
            $this->name = $data['name'];
        }

        if (isset($data['slug'])) {
            $this->slug = $data['slug'];
        }
    }


    // get methods
    public function getId()
    {
        return $this->id;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getSlug()
    {
        return $this->slug;
    }


    // query methods
    public static function findBySlug(string $cityName): self
    {
        $sql = "SELECT * FROM cities WHERE slug = :slug";
        $handle = static::$connection->pdo->prepare($sql);
        $params = [
            ':slug' => $cityName
        ];
        $handle->execute($params);
        $data = $handle->fetchAll(PDO::FETCH_ASSOC)[0];
        $data['id'] = (int) $data['id'];

        return new self($data);
    }

    /**
     * @return Realestate[]
     */
    public function getRealestates(): array
    {
        $handle = static::$connection->pdo->prepare(
            "SELECT 
            realestates.*
            FROM 
            realestates 
            JOIN cities ON realestates.city_id = cities.id 
            WHERE cities.slug = :slug"
        );
        $params = [
            ':slug' => $this->slug
        ];
        $handle->execute($params);
        $data = $handle->fetchAll(PDO::FETCH_ASSOC);
        $realestates = [];
        foreach ($data as $realestate) {
            $realestate['id'] = (int) $realestate['id'];
            $realestates[] = new Realestate($realestate);
        }
        return $realestates;
    }
}
