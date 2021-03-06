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

return [
    'default' => [
        'driver' => Hyperf\Cache\Driver\RedisDriver::class,
//        'driver' => \App\Service\RedisDriver::class,  //可以设置不同的config
        'packer' => Hyperf\Utils\Packer\PhpSerializerPacker::class,
        'prefix' => 'c:',
    ],
];
