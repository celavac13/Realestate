<?php

class RealestateController
{
    public function show(QueryBuilder $query, $cities, $totalInCity)
    {
        session_start();

        $cityId = [
            'cacak' => 1,
            'gornji-milanovac' => 2,
            'kraljevo' => 3,
            'nis' => 4,
            'ducalovici' => 5
        ];

        $realestates = $query->sortByCity($cityId[$_GET['estate']]);
        require 'app/views/index.view.php';
    }
}
