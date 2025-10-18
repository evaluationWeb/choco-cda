<?php

namespace App\Service\Logging\Writer;

use RuntimeException;

class FileLogWriter implements LogWriterInterface
{
    private string $logFile;

    public function __construct(?string $logFile = null)
    {
        $this->logFile = $logFile ?? $this->defaultPath();
    }

    public function write(string $formattedEntry): void
    {
        $result = @file_put_contents($this->logFile, $formattedEntry . PHP_EOL, FILE_APPEND | LOCK_EX);

        if ($result === false) {
            throw new RuntimeException(sprintf('Unable to write log entry to %s', $this->logFile));
        }
    }

    private function defaultPath(): string
    {
        return dirname(__DIR__, 4) . DIRECTORY_SEPARATOR . 'info.log';
    }
}
