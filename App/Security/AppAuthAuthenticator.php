<?php

namespace App\Security;

class AppAuthAuthenticator
{
    /**
     * Authenticate the user
     * @return void
     */
    public function authenticate() {}

    /**
     * Persist the grants in the session
     * @param array $grants An array of grants  to persist  in the session
     * @return void
     */
    private function persistSessionGrants(array $grants)
    {
        foreach ($grants as $grant) {
            $_SESSION["grants"][] = $grant;
        }
    }

    /**
     * Convert a comma-separated string of grants into an array
     * @param string $requiredGrants A comma-separated string of required grants
     * @return array An array of required grants
     */
    private function grantsToArray(string $requiredGrants): array
    {
        return explode(",", $requiredGrants);
    }

    /**
     * Destroy the session and redirect to the home page
     * @return void
     */
    public function endSession()
    {
        unset($_SESSION);
        session_destroy();
        header("Location: /");
        exit();
    }
}
