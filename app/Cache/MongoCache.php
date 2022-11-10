<?php

namespace App\Cache;

class MongoCache implements CacheInterface
{
    public function set(string $key, $value, int $expiration): bool
    {

        return true;
    }
    public function get(string $key)
    {
    }
    public function del(string $key): bool
    {

        return true;
    }
}
