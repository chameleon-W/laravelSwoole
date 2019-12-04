<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/12/4
 * Time: 15:19
 */

namespace ChameleonW\LaravelSwoole\Providers;


use ChameleonW\LaravelSwoole\Console\Commands\HttpServerCommand;
use ChameleonW\LaravelSwoole\Server\Manager;
use Illuminate\Support\ServiceProvider;
use Swoole\Http\Server as SwooleHttpServer;
use Swoole\WebSocket\Server as SwooleWebSocket;

class SwooleServiceProvider extends ServiceProvider
{
    protected static $server;
    /**
     * artisan command
     * @var array
     */
    protected $commands = [
        HttpServerCommand::class
    ];
    /**
     *  1. 注册swoole配置文件
     *  2. 注册swoole Server
     *  3. 注册swoole Manager
     *  4. 注册swoole 命令
     */
    public function register()
    {
        $this->registerConfig();
        $this->registerSwooleServer();
        $this->registerSwooleManager();
        $this->commands($this->commands);
    }

    public function boot(){

    }

    protected function registerConfig(){
        $this->mergeConfigFrom(
            __DIR__ . "/../Config/swoole.php" , 'extend.swoole'
        );
    }

    protected function registerSwooleServer(){
        $this->app->singleton('extend.swoole_server', function(){
            if(is_null(static::$server)){
                $this->createSwooleServer();
                $this->configSwooleServer();
            }
            return static::$server;
        });
    }

    protected function createSwooleServer(){
        $server = config('extend.swoole.socket_type') ? SwooleHttpServer::class : SwooleWebSocket::class;
        static::$server = new $server(config('extend.swoole.listen.host'), config('extend.swoole.listen.port'));
    }

    protected function configSwooleServer(){

    }

    protected function registerSwooleManager(){
        $this->app->singleton('extend.swoole_manager', function($app){
            return new Manager($app);
        });
    }

}