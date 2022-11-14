<?php

namespace App\Core;

class Request
{
    protected array $server;
    protected array $get;
    protected array $post;
    protected array $files;
    public function __construct()
    {
        $this->server = $_SERVER;
        $this->get = $_GET;
        $this->post = $_POST;
        $this->files = $_FILES;
    }

    public function getUri()
    {
        return trim(parse_url($this->server['REQUEST_URI'], PHP_URL_PATH), '/');
    }

    public function get(string $index)
    {
        return $this->get[$index];
    }

    public function post(string $index)
    {
        return $this->post[$index];
    }

    public function files(string $index)
    {
        return $this->files[$index];
    }
}
