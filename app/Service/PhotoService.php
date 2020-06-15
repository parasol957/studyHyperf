<?php


namespace App\Service;


use Hyperf\Guzzle\HandlerStackFactory;
use GuzzleHttp\Client;
use Swoole\Coroutine\Channel;

//use Swoole\Coroutine\Http\Client;

class PhotoService
{
    private $client;

    public function __construct()
    {
        $this->getGuzzle();  //获取对象

    }

    public function downPhoto()
    {


        $chan = new Channel(1);
        $time1 = microtime(true);
        $photoUrl = 'http://og9j6rxfr.bkt.clouddn.com/5039920180725114926214.jpg';
        go(function () use ($photoUrl, $chan) {
            $path = '';
            $photoData = $this->client->get($photoUrl);
            if ($photoData->getStatusCode() == 200) {  //表示请求成功
                $path = BASE_PATH . "/runtime/photo/" . uniqid() . '.png';
//            var_dump($path);
                $fp = fopen($path, "a+");
                fwrite($fp, $photoData->getBody()->getContents());
                fclose($fp);
            }
            $chan->push(array(
                'path' => $path
            ));
        });
        $data = $chan->pop();  //获取协程的值
        var_dump($data);
        echo microtime(true) - $time1 . PHP_EOL;


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