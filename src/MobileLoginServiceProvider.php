<?php
namespace MobileLogin ;
use Illuminate\Support\ServiceProvider;

class MobileLoginServiceProvider extends ServiceProvider
{
    protected function loadRoutes(){
        $this->loadRoutesFrom(__DIR__."/../routes/api.php");
    }
    protected function publishConfigs(){
        $this->publishes([ __DIR__.'/../config/mobileLogin.php' => config_path('mobileLogin.php'),]);
    }
    public function boot()
    {
        $this->loadRoutes();
        $this->publishConfigs();

    }

    public function register()
    {
//        parent::register();
//        $this->mergeConfigFrom(
//            __DIR__.'/../config/Login_with_sms.php', 'courier'
//        );



    }







}
