<?php


namespace App\Service;


use Hyperf\Redis\RedisProxy;
use Psr\Container\ContainerInterface;

class RedisDriver extends \Hyperf\Cache\Driver\RedisDriver
{
    public function __construct(ContainerInterface $container, array $config)
    {
        parent::__construct($container, $config);
        $this->redis = make(RedisProxy::class, array('pool' => 'cache'));
    }

}