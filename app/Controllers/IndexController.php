<?php

namespace App\Controllers;

use App\Core\Database\QueryBuilder;

class IndexController
{
    public function index(QueryBuilder $query)
    {
        $realestates = $query->selectAll("realestates");

        require 'views/index.view.php';
    }
}
