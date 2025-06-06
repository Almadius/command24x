<?php

namespace CommandProcessor\Logger;

use Psr\Log\AbstractLogger;

class SimpleLogger extends AbstractLogger
{
    public function log($level, $message, array $context = []): void
    {
        $timestamp = date('Y-m-d H:i:s');
        echo "[{$timestamp}] " . strtoupper($level) . ': ' . $message . PHP_EOL;
    }
}
