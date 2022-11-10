<?php

namespace App\Cache;

use Predis\Client;

class RedisCache implements CacheInterface
{
    protected Client $client;
    public function __construct(Client $client)
    {
        $this->client = $client;
    }
    public function set(string $key, $value, int $expiration): bool
    {
        $this->client->set($key, serialize($value), 'EX', $expiration);
        return true;
    }
    public function get(string $key)
    {
        return unserialize($this->client->get($key));
    }
    public function del(string $key): bool
    {
        $this->client->get($key);
        return true;
    }
}
