<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\CacheService;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\AutoController;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;

/**
 * Class CacheController
 * @package App\Controller
 * @AutoController(prefix="cache")
 */
class CacheController extends AbstractController
{
    /**
     * @Inject()
     * @var CacheService
     */
    protected $service;

    public function index()
    {
        $result = $this->service->getCache();

        return $this->response->json(array('data' => $result));
    }

    public function put()
    {
        $result = $this->service->putCache();
        return $this->response->json(array(
            'data' => $result
        ));

    }
}
