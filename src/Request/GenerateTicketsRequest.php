<?php

namespace Request;

use Prototype\Response\ValidateResponsePrototype;

class GenerateTicketsRequest
{
    private array $data;

    public function __construct()
    {
        $this->data = json_decode(file_get_contents('php://input'), true) ?? [];
    }

    public function validate(): void
    {
        if (!isset($this->data['quantity']) || !is_int($this->data['quantity']) || $this->data['quantity'] <= 0 || $this->data['quantity'] > 50) {
            ValidateResponsePrototype::error("The 'quantity' field is required, must be a positive integer, and cannot exceed 50.");
        }

        if (!isset($this->data['numbers']) || !is_int($this->data['numbers']) || $this->data['numbers'] < 6 || $this->data['numbers'] > 10) {
            ValidateResponsePrototype::error("The 'numbers' field is required, must be an integer, and must be between 6 and 10.");
        }
    }



    public function input(string $key, $default = null)
    {
        return $this->data[$key] ?? $default;
    }
}
