<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

abstract class BaseService
{
    /**
     * Log an action with context
     */
    protected function log(string $message, array $context = []): void
    {
        Log::info($message, $context);
    }
}
