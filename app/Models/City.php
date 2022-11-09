<?php

namespace App\Models;

use PDO;

class City
{
    protected static PDO $connection;
    protected int $id;
    protected string $name;
    protected string $slug;

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


    // set methods
    public static function setDB(PDO $connection)
    {
        static::$connection = $connection;
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
        $handle = static::$connection->prepare($sql);
        $params = [
            ':slug' => $cityName
        ];
        $handle->execute($params);
        $data = $handle->fetchAll(PDO::FETCH_ASSOC)[0];
        $data['id'] = (int) $data['id'];

        return new self($data);
    }

    /**
     * @return static[]
     */
    public static function all(): array
    {
        $handle = static::$connection->prepare("SELECT * FROM cities");
        $handle->execute();
        $data = $handle->fetchAll(PDO::FETCH_ASSOC);

        foreach ($data as $city) {
            $city['id'] = (int) $city['id'];
            $cities[] = new self($city);
        }
        return $cities;
    }

    /**
     * @return Realestate[]
     */
    public function getRealestates(): array
    {
        $handle = static::$connection->prepare(
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

        foreach ($data as $realestate) {
            $realestate['id'] = (int) $realestate['id'];
            $realestates[] = new Realestate($realestate);
        }
        return $realestates;
    }
}
