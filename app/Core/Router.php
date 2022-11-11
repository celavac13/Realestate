<?php

namespace App\Core;

class Router
{
    protected array $routes;
    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }
    public function getRoutes()
    {
        return $this->routes;
    }
}
