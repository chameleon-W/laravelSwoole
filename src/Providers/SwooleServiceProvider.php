<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/12/4
 * Time: 15:19
 */

namespace ChameleonW\LaravelSwoole\Providers;


use Illuminate\Support\ServiceProvider;

class SwooleServiceProvider extends ServiceProvider
{
    public function register()
    {
        var_dump(11111);
    }

    public function boot(){

    }
}