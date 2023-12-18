<?php

namespace App\Services;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;

class LoggerService
{
    protected $logger;

    public function __construct()
    {
        $this->setupLogger();
    }

    private function setupLogger()
    {
        $this->logger = new Logger('admin_logger');
        $this->logger->pushHandler(
            new StreamHandler(storage_path('logs/admin/laravel-' . now()->format('Y-m-d') . '.log'), Logger::DEBUG)
        );
        $this->logger->pushHandler(new FirePHPHandler());
    }

}