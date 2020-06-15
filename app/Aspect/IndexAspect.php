<?php

namespace App\Aspect;

use App\Controller\IndexController;
use Hyperf\Di\Annotation\Aspect;
use Hyperf\Di\Aop\AbstractAspect;



use Hyperf\Di\Aop\ProceedingJoinPoint;

///**
// * @Aspect()
// */
class IndexAspect extends AbstractAspect
{
    public $classes = [
        IndexController::class . '::' . 'index',
    ];

    public function process(ProceedingJoinPoint $proceedingJoinPoint)
    {
//        var_dump($proceedingJoinPoint);

        $result = $proceedingJoinPoint->process();
        return '222' . $result . 'qqq';
    }
}