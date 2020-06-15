<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf-cloud/hyperf/blob/master/LICENSE
 */

namespace App\Controller;

use App\Model\Member;
use App\Model\Model;
use App\Service\PhotoService;
use Hyperf\Di\Annotation\Inject;
use Psr\Container\ContainerInterface;
use Psr\EventDispatcher\EventDispatcherInterface;
use App\Event\UserRegistered;
use Hyperf\Cache\Annotation\Cacheable;
use Swoole\Coroutine;
use Swoole\Timer;
use Hyperf\Guzzle\HandlerStackFactory;
use GuzzleHttp\Client;
use Hyperf\Utils\Parallel;
use Hyperf\HttpServer\Contract\RequestInterface;

class IndexController extends AbstractController
{


    public function index(RequestInterface $request)
    {

        $photoURL = $request->input('photoURL');
        if (empty($photoURL)) {
            return 1;
        }
        $photoService = make(PhotoService::class, array('photoURL' => $photoURL));
        $photoService->downPhoto();
        $photoService->downSwoolePhoto();
        $photoService->fileGet();
    }

    public function getTime($id, $task)
    {
//        var_dump($id);
//        var_dump($task);
//        echo date('Y-m-d H:i:s') . PHP_EOL;

    }


}
