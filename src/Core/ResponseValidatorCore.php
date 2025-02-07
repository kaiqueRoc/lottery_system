<?php

namespace Core;

use JetBrains\PhpStorm\NoReturn;

class ResponseValidatorCore
{
    #[NoReturn] public static function json($data, $status = 200): void
    {
        header('Content-Type: application/json');
        http_response_code($status);
        echo json_encode($data);
        exit;
    }

    #[NoReturn] public static function error($message, $status = 400): void
    {
        self::json(['error' => $message], $status);
    }
}
