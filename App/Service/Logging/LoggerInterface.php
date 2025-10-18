<?php

namespace App\Service\Logging;

interface LoggerInterface
{
    public function log(string $level, string $message, ?string $user = null, ?string $ip = null): void;

    public function info(string $message, ?string $user = null, ?string $ip = null): void;

    public function warning(string $message, ?string $user = null, ?string $ip = null): void;

    public function error(string $message, ?string $user = null, ?string $ip = null): void;

    public function logRequest(?string $message = null): void;
}
