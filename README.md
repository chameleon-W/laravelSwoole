<h1 align="center"> laravelSwoole </h1>

<p align="center"> 基于laravel组件化开发的简易版swoole组件.</p>


## 安装环境
    1.PHP >= 7.2
    2.Composer
    3.laravel >= 5.8
    4.Swoole >=4.4.x


## 安装

```shell
$ composer require chameleon-w/laravelswoole
```

## 配置
    1.在config/app.php中注册 SwooleServiceProvider
        'providers' => [
            // ...
           \ChameleonW\LaravelSwoole\Providers\SwooleServiceProvider::class,
        ],
        
    2.在env中配置
        SWOOLE_LISTEN_HOST=0.0.0.0 //监听的ip
        SWOOLE_LISTEN_PORT=9501    //监听的端口
        
    3.访问 http://127.0.0.1:9501


## 尚未完善
    1. 当前为demo版本 请不要用于生产环境
    2. 代码热加载
    3. WebSocket封装