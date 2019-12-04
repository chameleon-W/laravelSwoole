<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/12/4
 * Time: 16:43
 */

namespace ChameleonW\LaravelSwoole\Server;

//use ShineYork\LaravelExtend\Swoole\Http\SRequest;
//use ShineYork\LaravelExtend\Swoole\Http\SResponse;
use ChameleonW\LaravelSwoole\Http\SRequest;
use ChameleonW\LaravelSwoole\Http\SResponse;
use Illuminate\Contracts\Container\Container;
use Mockery\Exception;

class Manager
{
    protected $server;

    protected $laravel;

    protected $events = [
        'http' => [
            'request' => 'onRequest'
        ],
        'websocket' => [

        ]
    ];

    public function __construct(Container $laravel)
    {
        $this->laravel = $laravel;
        $this->server = $this->laravel->make('extend.swoole_server');
        $this->setSwooleServerEvent();
    }

    protected function setSwooleServerEvent(){
        $type = config('extend.swoole.socket_type') ? 'http' : 'websocket';
        foreach($this->events[$type] as $event => $func) {
            $this->server->on($event, [$this, $func]);
        }
    }

    public function onRequest($swooleRequest, $swooleResponse){
        try{
            $laravelRequest = SRequest::make($swooleRequest);
            $laravelResponse = $this->laravel->make(\Illuminate\Contracts\Http\Kernel::class)->handle($laravelRequest);
            SResponse::make($laravelResponse, $swooleResponse)->send();
        } catch (\Exception $e){
            var_dump($e->getMessage());
        }
    }

    public function run(){
        $this->server->start();
    }

}