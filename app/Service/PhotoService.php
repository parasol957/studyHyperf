<?php


namespace App\Service;


use Hyperf\Guzzle\HandlerStackFactory;
use GuzzleHttp\Client;
use Swoole\Coroutine\Channel;

use Swoole\Coroutine\Http\Client as swooleClient;

class PhotoService
{
    private $client;
    private $photoURL;

    public function __construct($photoURL)
    {
        $this->photoURL = $photoURL;
        $this->getGuzzle();  //获取对象

    }

    /**
     * 测试使用Guzzle下载图片
     */
    public function downPhoto()
    {

        $time1 = microtime(true);
        $chan = new Channel(1);
        $photoUrl = $this->photoURL;
        go(function () use ($photoUrl, $chan) {
            $path = '';
            $photoData = $this->client->get($photoUrl);
            if ($photoData->getStatusCode() == 200) {  //表示请求成功
                $path = BASE_PATH . "/runtime/photo/" . uniqid() . 'Guzzle.png';
                $fp = fopen($path, "a+");
                fwrite($fp, $photoData->getBody()->getContents());
                fclose($fp);
            }
            $chan->push(array(
                'path' => $path
            ));
        });
        $chan->pop();  //获取协程的值
        $time2 = microtime(true) - $time1;
        echo 'Guzzle: ' . $time2 . PHP_EOL;
    }

    public function downSwoolePhoto()
    {
        $time1 = microtime(true);
        $chan = new Channel(1);
        $photoUrl = $this->photoURL;
        go(function () use ($photoUrl, $chan) {
            $host = parse_url($photoUrl)['host'];
            $client = new swooleClient($host, 80);
            $client->set(['timeout' => -1]);
            $path = BASE_PATH . "/runtime/photo/" . uniqid() . 'Swoole.png';
            $client->download(parse_url($photoUrl)['path'], $path);
            $chan->push(array(
                'path' => $path
            ));
        });
        $chan->pop();  //获取协程的值
        $time2 = microtime(true) - $time1;
        echo 'Swoole: ' . $time2 . PHP_EOL;
    }

    public function fileGet()
    {
        $time1 = microtime(true);
        $chan = new Channel(1);
        $photoUrl = $this->photoURL;
        go(function () use ($photoUrl, $chan) {
            $path = BASE_PATH . "/runtime/photo/" . uniqid() . 'fileGet.png';
            $resData = file_get_contents($photoUrl);
            file_put_contents($path, $resData);
            $chan->push(array(
                'path' => $path
            ));
        });
        $chan->pop();  //获取协程的值
        $time2 = microtime(true) - $time1;
        echo 'fileGet: ' . $time2 . PHP_EOL;


    }


    public function getGuzzle()
    {
        $factory = new HandlerStackFactory();
        $stack = $factory->create();

        $this->client = make(Client::class, [
            'config' => [
                'handler' => $stack,
            ],
        ]);

//        return $this->client ;
    }

}