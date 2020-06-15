<?php


namespace App\Service;


use Hyperf\Guzzle\HandlerStackFactory;
use GuzzleHttp\Client;

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
        $photoUrl = 'http://og9j6rxfr.bkt.clouddn.com/5039920180725114926214.jpg';

        $photoData = $this->client->get($photoUrl);
//        var_dump($photoData->getStatusCode );
        if ($photoData->getStatusCode() == 200) {  //表示请求成功
            $path = BASE_PATH . "/runtime/photo";
            if (!file_exists($path)) {
                mkdir($path);
            }
            $fp = fopen($path, "a+");
            fwrite($fp, $photoData->getBody()->getContents());
            fclose($fp);
        }


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