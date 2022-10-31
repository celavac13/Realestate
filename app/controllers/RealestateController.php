<?php

class RealestateController
{
    public function show(QueryBuilder $query, $cities, $totalInCity)
    {
        $selectAll = $query->selectAll('realestates');
        $realestates[] = $selectAll[array_search($_GET['estate'], array_column($selectAll, 'id'))];

        require 'app/views/index.view.php';
    }
}
