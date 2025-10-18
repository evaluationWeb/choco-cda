<?php

namespace App\Service\Logging;

final class LogLevel
{
    public const INFO = 'INFO';
    public const WARNING = 'WARNING';
    public const ERROR = 'ERROR';

    private const ALLOWED = [
        self::INFO,
        self::WARNING,
        self::ERROR,
    ];

    private function __construct()
    {
    }

    public static function normalize(string $level): string
    {
        return strtoupper(trim($level));
    }

    public static function isValid(string $level): bool
    {
        return in_array($level, self::ALLOWED, true);
    }
}

