<?php

namespace App\Cache;

interface CacheInterface
{
    public function set(string $key, $value, int $expiration): bool;
    public function get(string $key);
    public function del(string $key): bool;
}
