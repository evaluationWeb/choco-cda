<?php

namespace App\Service\Logging;

use DateTimeImmutable;

final class LogEntry
{
    public function __construct(
        private string $level,
        private string $message,
        private DateTimeImmutable $timestamp,
        private LogContext $context
    ) {
    }

    public function getLevel(): string
    {
        return $this->level;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getTimestamp(): DateTimeImmutable
    {
        return $this->timestamp;
    }

    public function getContext(): LogContext
    {
        return $this->context;
    }
}

