<?php

namespace App\Core;

class Request
{
    protected string $uri;
    public function __construct(string $uri)
    {
        $this->uri = trim(parse_url($uri, PHP_URL_PATH), '/');
    }

    public function getUri()
    {
        return $this->uri;
    }

    public function get(string $index)
    {
        return $_GET["{$index}"];
    }

    public function post(string $index)
    {
        return $_POST["{$index}"];
    }

    public function files(string $index)
    {
        return $_FILES["{$index}"];
    }
}
