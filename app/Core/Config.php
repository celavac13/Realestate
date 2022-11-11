<?php

namespace App\Core;

class Config
{
    protected array $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function get(string $key)
    {
        return $this->config[$key];
    }
}
