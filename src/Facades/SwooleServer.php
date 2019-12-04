<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/12/4
 * Time: 16:41
 */

namespace ChameleonW\LaravelSwoole\Facades;


use Illuminate\Support\Facades\Facade;

class SwooleServer extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'extend.swoole_server';
    }
}