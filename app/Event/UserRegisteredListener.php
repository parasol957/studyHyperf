<?php


namespace App\Event;

use App\Event\UserRegistered;
use Hyperf\Event\Contract\ListenerInterface;

class UserRegisteredListener implements ListenerInterface
{

    public function listen(): array
    {
        return array(
            UserRegistered::class
        );
    }

    /**
     * @param object $data
     * 最后触发
     */
    public function process(object $data)
    {
        var_dump($data);
    }
}