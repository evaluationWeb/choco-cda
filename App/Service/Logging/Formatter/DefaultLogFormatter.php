<?php

namespace App\Service\Logging\Formatter;

use App\Service\Logging\LogEntry;

class DefaultLogFormatter implements LogFormatterInterface
{
    public function format(LogEntry $entry): string
    {
        $timestamp = $entry->getTimestamp()->format('Y-m-d H:i:s');
        $context = $entry->getContext();
        $base = sprintf(
            '[%s][%s][ip=%s][user=%s] %s',
            $timestamp,
            $entry->getLevel(),
            $context->getIp(),
            $context->getUser(),
            $entry->getMessage()
        );

        $extra = $context->getExtra();
        if (!empty($extra)) {
            $serialized = json_encode($extra, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
            if ($serialized !== false) {
                $base .= ' ' . $serialized;
            }
        }

        return $base;
    }
}

