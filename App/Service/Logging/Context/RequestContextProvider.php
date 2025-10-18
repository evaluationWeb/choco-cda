<?php

namespace App\Service\Logging\Context;

use App\Service\Logging\LogContext;

class RequestContextProvider implements ContextProviderInterface
{
    public function provide(?string $user = null, ?string $ip = null): LogContext
    {
        $resolvedIp = $ip ?? $this->detectIp();
        $resolvedUser = $user ?? $this->detectUser();

        return new LogContext($resolvedUser, $resolvedIp);
    }

    private function detectIp(): string
    {
        $keys = [
            'HTTP_CLIENT_IP',
            'HTTP_X_FORWARDED_FOR',
            'HTTP_X_FORWARDED',
            'HTTP_X_CLUSTER_CLIENT_IP',
            'HTTP_FORWARDED_FOR',
            'HTTP_FORWARDED',
            'REMOTE_ADDR',
        ];

        foreach ($keys as $key) {
            if (!empty($_SERVER[$key])) {
                $value = $_SERVER[$key];
                if (strpos($value, ',') !== false) {
                    $value = trim(explode(',', $value)[0]);
                }
                return $value;
            }
        }

        return PHP_SAPI === 'cli' ? 'CLI' : 'UNKNOWN';
    }

    private function detectUser(): string
    {
        if (isset($_SESSION)) {
            if (isset($_SESSION['username']) && is_string($_SESSION['username'])) {
                return $_SESSION['username'];
            }
            if (isset($_SESSION['user'])) {
                $user = $_SESSION['user'];
                if (is_string($user)) {
                    return $user;
                }

                if (is_array($user)) {
                    foreach (['username', 'email', 'login', 'name', 'id'] as $key) {
                        if (isset($user[$key])) {
                            return (string) $user[$key];
                        }
                    }
                }
            }
        }

        return 'anonymous';
    }
}

