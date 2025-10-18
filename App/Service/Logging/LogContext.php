<?php

namespace App\Service\Logging;

final class LogContext
{
    public function __construct(
        private string $user,
        private string $ip,
        private array $extra = []
    ) {
    }

    public function getUser(): string
    {
        return $this->user;
    }

    public function getIp(): string
    {
        return $this->ip;
    }

    public function getExtra(): array
    {
        return $this->extra;
    }
}

