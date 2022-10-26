<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
define('SITE_ROOT', realpath(dirname(__FILE__)));

$query = require 'core/bootstrap.php';

$cities = $query->selectAll("cities");
$totalInCity = fn ($cityId) => $query->sortByCity($cityId);


require 'app/routes.php';
