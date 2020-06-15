<?php


namespace App\Event;


use Hyperf\Event\Contract\ListenerInterface;

class userUpdate implements ListenerInterface
{
    public function listen(): array
    {
        // TODO: Implement listen() method.
    }

    public function process(object $event)
    {
        var_dump($event);

    }


}