<?php

namespace App\Controller;

abstract class AbstractController
{
    public function render(string $template, array $data =[]): void {

        include "../" . $template . ".php";
    }

    public function jsonResponse(array $data, int $statusCode): void {
        $json = json_encode($data);
        http_response_code($statusCode);
        echo $json;
    }
}