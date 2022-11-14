<?php

namespace App\Core;

use App\Cache\CacheInterface;
use App\Cache\RedisCache;
use App\Models\Model;
use DI\Container;
use App\Core\Database\Connection;

class App
{
    protected Container $container;
    protected Router $router;
    protected Config $config;

    public function __construct(Container $container, Router $router, Config $config)
    {
        $this->container = $container;
        $this->router = $router;
        $this->config = $config;
    }

    public function boot()
    {
        $this->container->set(RedisCache::class, fn () => new RedisCache(new \Predis\Client()));
        $this->container->set(CacheInterface::class, fn () => $this->container->get(RedisCache::class));
        $this->container->set(Connection::class, fn () => Connection::make($this->config->get('database')));
        $this->container->set(Request::class, fn () => new Request());
        $this->container->set(Response::class, fn () => new Response());
        Model::setDB($this->container->get(Connection::class));
    }

    public function run()
    {
        $response = $this->container->call(
            $this->router->resolve(
                $this->container->get(Request::class)
            )
        );
        $response->send();
    }
}
