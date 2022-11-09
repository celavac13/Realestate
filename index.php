<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require 'bootstrap.php';
session_start();

use App\Core\Database\QueryBuilder;

$query = new QueryBuilder($connection);

$cities = $query->selectAll("cities");
$totalInCity = fn ($slug) => $query->sortByCity($slug);

require 'routes.php';
