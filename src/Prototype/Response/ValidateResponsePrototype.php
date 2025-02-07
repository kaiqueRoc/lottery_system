<?php
namespace Prototype\Response;

use Enum\HttpStatusCode;
use JetBrains\PhpStorm\NoReturn;

class ValidateResponsePrototype
{
    #[NoReturn] public static function success(array $data = [], HttpStatusCode $code = HttpStatusCode::OK): void
    {
        self::sendResponse($data, $code->value, 'success');
    }

    #[NoReturn] public static function error(string $message, HttpStatusCode $code = HttpStatusCode::BAD_REQUEST): void
    {
        self::sendResponse(['error' => $message], $code->value, 'error');
    }


    #[NoReturn] private static function sendResponse(array $data, int $code, string $status): void
    {
        http_response_code($code);
        header('Content-Type: application/json');
        echo json_encode([
            'status' => $status,
            'code' => $code,
            'data' => $data
        ], JSON_PRETTY_PRINT);
        exit;
    }
}
