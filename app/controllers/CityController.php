<?php

class CityController
{
    public function show(QueryBuilder $query, $cities, $totalInCity)
    {
        $realestates = $query->sortByCity($_GET['city']);
        require 'app/views/index.view.php';
    }
}
