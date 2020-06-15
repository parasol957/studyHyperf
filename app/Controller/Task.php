<?php


namespace App\Controller;

use Hyperf\Cache\Listener\DeleteListenerEvent;
use Hyperf\HttpServer\Annotation\AutoController;
use Psr\Container\ContainerInterface;

/**
 * Class Task
 * @package App\Controller
 * @AutoController
 */
class Task
{
    public function index()
    {
        return date('Y-m-d H:i:s');

    }

}