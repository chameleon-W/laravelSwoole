<?php

namespace ChameleonW\LaravelSwoole\Console\Commands;

use Illuminate\Console\Command;

class HttpServerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'extend:swoole {action : start|stop|restart|reload|infos}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'vendor:LaravelSwoole commands';

    /**
     * Swoole Manager
     * @var object
     */
    protected $manager;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 1. 执行对Swoole Server操作
     * 2. 友好提示
     * 3. 注册Swoole Manager
     * @return mixed
     */
    public function handle()
    {
        $this->info("http://".config('extend.swoole.listen.host').":".config('extend.swoole.listen.port'));
        $this->manager = $this->laravel->make('extend.swoole_manager');
        $this->execution();
    }

    protected function execution(){
        return $this->{$this->argument('action')}();
    }

    /**
     * 开启swoole服务
     * @return string
     */
    protected function start(){
        $this->manager->run();
    }

    /**
     * 停止
     * @return string
     */
    protected function stop(){
        return 'stop';
    }

    /**
     * 重启
     * @return string
     */
    protected function restart(){
        return 'restart';
    }

    /**
     * 重新加载
     * @return string
     */
    protected function reload(){
        return 'reload';
    }

    /**
     * 信息
     * @return string
     */
    protected function infos(){
        echo "extend:swoole start|stop|restart|reload|infos";
    }
}
