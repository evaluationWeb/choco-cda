<?php

namespace App\Service\Logging\Formatter;

use App\Service\Logging\LogEntry;

interface LogFormatterInterface
{
    public function format(LogEntry $entry): string;
}

