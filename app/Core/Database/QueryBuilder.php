<?php

namespace App\Core\Database;

use PDO;

class QueryBuilder
{
    public $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
}
