<?php

namespace App\Service\Logging\Context;

use App\Service\Logging\LogContext;

interface ContextProviderInterface
{
    public function provide(?string $user = null, ?string $ip = null): LogContext;
}

