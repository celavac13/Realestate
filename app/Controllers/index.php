<?php

namespace App\Controllers;

$realestates = $query->selectAll("realestates");

require 'app/views/index.view.php';
