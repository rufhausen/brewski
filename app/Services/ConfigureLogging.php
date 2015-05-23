<?php namespace App\Services;

/*
 *
 * Credit and info about adding singleton to bootstrap/app.php on this thread on Laracasts:
 * https://laracasts.com/discuss/channels/general-discussion/error-on-overriding-configurelogging-bootstrap-class?page=1#reply-42802
 *
 */

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Bootstrap\ConfigureLogging as BaseConfigureLogging;
use Illuminate\Log\Writer;
use Illuminate\Support\Facades\Log as Log;
use Monolog\Handler\StreamHandler as StreamHandler;
use Monolog\Processor\MemoryPeakUsageProcessor as MemoryPeakUsageProcessor;
use Monolog\Processor\MemoryUsageProcessor as MemoryUsageProcessor;
use Monolog\Processor\WebProcessor;

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
        $logger          = $log->getMonolog();
        $logfile_handler = new StreamHandler(storage_path() . '/logs/laravel.log');
        $logger->pushHandler($logfile_handler);
        $logger->pushProcessor(new MemoryUsageProcessor);
        $logger->pushProcessor(new MemoryPeakUsageProcessor);
        $logger->pushProcessor(new WebProcessor);
    }

}
