<?php

namespace App\Controller;

abstract class AbstractController
{
    public function render(string $template, array $data =[]): void {
        // Expose $data as variables in template (e.g., ['user' => '...'] => $user)
        if (!empty($data)) {
            extract($data, EXTR_SKIP);
        }
        include "../" . $template . ".php";
    }

    public function jsonResponse(array $data, int $statusCode): void {
        $json = json_encode($data);
        http_response_code($statusCode);
        echo $json;
    }
}
