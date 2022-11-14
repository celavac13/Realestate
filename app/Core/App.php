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
    protected string $uri;

    public function __construct(Container $container, Router $router, Config $config, string $uri)
    {
        $this->container = $container;
        $this->router = $router;
        $this->config = $config;
        $this->uri = $uri;
    }

    public function boot()
    {
        $this->container->set(RedisCache::class, fn () => new RedisCache(new \Predis\Client()));
        $this->container->set(CacheInterface::class, fn () => $this->container->get(RedisCache::class));
        $this->container->set(Connection::class, fn () => Connection::make($this->config->get('database')));
        $this->container->set(Request::class, fn () => new Request($this->uri));
        Model::setDB($this->container->get(Connection::class));
    }

    public function run()
    {
        $this->container->call(
            $this->router->getRoutes(
                $this->container->call([Request::class, 'getUri'])
            )
        );
    }
}
