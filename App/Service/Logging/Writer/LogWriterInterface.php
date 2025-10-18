<?php

namespace App\Service\Logging\Writer;

interface LogWriterInterface
{
    public function write(string $formattedEntry): void;
}

