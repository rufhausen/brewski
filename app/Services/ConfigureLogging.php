<?php

namespace App\Services;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Bootstrap\ConfigureLogging as BaseConfigureLogging;
use Illuminate\Log\Writer;
use Illuminate\Support\Facades\Log as Log;
use Monolog\Handler\StreamHandler as StreamHandler;

class ConfigureLogging extends BaseConfigureLogging
{

    /**
     * Custom Monolog handler that for Logentries.
     *
     * @param  \Illuminate\Contracts\Foundation\Application  $app
     * @param  \Illuminate\Log\Writer  $log
     * @return void
     */
    protected function configureHandlers(Application $app, Writer $log)
    {
        $logger         = $log->getMonolog();
        $logfileHandler = new StreamHandler(storage_path() . '/logs/laravel.log');
        $logger->pushHandler($logfileHandler);
        $logger->pushProcessor(new \Monolog\Processor\MemoryUsageProcessor);
        $logger->pushProcessor(new \Monolog\Processor\MemoryPeakUsageProcessor);
        $logger->pushProcessor(new \Monolog\Processor\WebProcessor);
    }
}
