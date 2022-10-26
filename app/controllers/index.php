<?php
session_start();
$realestates = $query->selectAll("realestates");

require 'app/views/index.view.php';
