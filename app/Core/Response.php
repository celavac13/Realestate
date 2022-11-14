<?php

namespace App\Core;

class Response
{
    protected array $data;
    protected string $view;
    protected bool $json = false;
    protected string $redirect;
    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function data(array $data): self
    {
        $this->data = $data;
        return $this;
    }

    public function view(string $viewName): self
    {
        $this->view = $viewName;
        return $this;
    }

    public function json(): self
    {
        $this->json = true;
        return $this;
    }

    public function redirect(string $url): self
    {
        $this->redirect = $url;
        return $this;
    }

    public function send()
    {
        if (isset($this->view)) {
            extract($this->data);
            require "../views/{$this->view}.view.php";
        } elseif ($this->json) {
            echo json_encode($this->data);
        } elseif (isset($this->redirect)) {
            header("location: {$this->redirect}");
        }
    }
}
