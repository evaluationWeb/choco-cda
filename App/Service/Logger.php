<?php

namespace App\Service;

use App\Service\Logging\Context\ContextProviderInterface;
use App\Service\Logging\Context\RequestContextProvider;
use App\Service\Logging\Exception\InvalidLogLevelException;
use App\Service\Logging\Formatter\DefaultLogFormatter;
use App\Service\Logging\Formatter\LogFormatterInterface;
use App\Service\Logging\LogEntry;
use App\Service\Logging\LogLevel;
use App\Service\Logging\LoggerInterface;
use App\Service\Logging\Writer\FileLogWriter;
use App\Service\Logging\Writer\LogWriterInterface;
use DateTimeImmutable;
use InvalidArgumentException;

class Logger implements LoggerInterface
{
    private LogWriterInterface $writer;
    private LogFormatterInterface $formatter;
    private ContextProviderInterface $contextProvider;

    public function __construct(
        ?LogWriterInterface $writer = null,
        ?LogFormatterInterface $formatter = null,
        ?ContextProviderInterface $contextProvider = null
    ) {
        $this->writer = $writer ?? new FileLogWriter();
        $this->formatter = $formatter ?? new DefaultLogFormatter();
        $this->contextProvider = $contextProvider ?? new RequestContextProvider();
    }

    public static function createDefault(?string $logFile = null): self
    {
        return new self(new FileLogWriter($logFile));
    }

    public function log(string $level, string $message, ?string $user = null, ?string $ip = null): void
    {
        $normalizedLevel = LogLevel::normalize($level);

        if (!LogLevel::isValid($normalizedLevel)) {
            throw new InvalidLogLevelException(sprintf('Invalid log level: %s', $level));
        }

        if (trim($message) === '') {
            throw new InvalidArgumentException('Log message cannot be empty');
        }

        $context = $this->contextProvider->provide($user, $ip);

        $entry = new LogEntry(
            $normalizedLevel,
            $message,
            new DateTimeImmutable(),
            $context
        );

        $formatted = $this->formatter->format($entry);
        $this->writer->write($formatted);
    }

    public function info(string $message, ?string $user = null, ?string $ip = null): void
    {
        $this->log(LogLevel::INFO, $message, $user, $ip);
    }

    public function warning(string $message, ?string $user = null, ?string $ip = null): void
    {
        $this->log(LogLevel::WARNING, $message, $user, $ip);
    }

    public function error(string $message, ?string $user = null, ?string $ip = null): void
    {
        $this->log(LogLevel::ERROR, $message, $user, $ip);
    }

    public function logRequest(?string $message = null): void
    {
        $method = $_SERVER['REQUEST_METHOD'] ?? 'CLI';
        $uri = $_SERVER['REQUEST_URI'] ?? '';
        $baseMessage = $message ?? sprintf('Request %s %s', $method, $uri);

        $this->info($baseMessage);
    }
}
