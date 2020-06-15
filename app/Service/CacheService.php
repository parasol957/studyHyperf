<?php


namespace App\Service;


use Hyperf\Cache\Annotation\Cacheable;
use Hyperf\Cache\Annotation\CachePut;

class CacheService
{

    /**
     * @param string $name
     * @return string
     * @Cacheable(prefix="cache")
     */
    public function getCache(string $name = 'wanglei')
    {
        return $this->get($name);
    }

    /**
     * @param string $name
     * @return string
     * @CachePut(prefix="cache")
     */
    public function putCache(string $name = 'Hyperf')
    {
        return $this->get($name);
    }

    public function get(string $name = 'Hypef')
    {
        var_dump($name . uniqid());
        sleep(1);
        return $name . uniqid();
    }
}