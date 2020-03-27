<?php

namespace Bitwise\Logger;

use Illuminate\Support\ServiceProvider;

class BitwiseLoggerProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadMigrationsFrom(__DIR__.'/../migrations');

        $this->publishes([
            __DIR__.'/config/bitwise_logger.php'=>config_path('bitwise_logger.php')
        ],'bitwise-logger');

        $this->app->singleton('Logger',function(){
            $log =  new \Bitwise\Logger\Models\Log();
            $ignoresExceptions = config('bitwise_logger.ignore_exceptions');
            $log->setIgnoreExceptions($ignoresExceptions);
            return $log;
        });

        $this->registerLogChannel();
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    protected function registerLogChannel(){
        $logChannels = config('logging.channels');
        $logChannel = ['bitwise_logger'=>[
            'driver'=>'custom',
            'via'=>BitwiseLogger::class]
        ];
        $channelsWithBitwiseChannel  = array_merge($logChannels,$logChannel);
        config(['logging.channels' => $channelsWithBitwiseChannel]);
    }
}
