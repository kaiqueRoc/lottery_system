<?php

namespace Request;

use Prototype\Response\ValidateResponsePrototype;

class CheckTicketsRequest
{
    private array $data;

    public function __construct()
    {
        $this->data['winning_ticket'] = isset($_GET['winning_ticket']) ? json_decode($_GET['winning_ticket'], true) : [];
        $this->data['tickets'] = isset($_GET['tickets']) ? json_decode($_GET['tickets'], true) : [];
    }

    public function validate(): void
    {
        if (!is_array($this->data['winning_ticket']) || empty($this->data['winning_ticket'])) {
            ValidateResponsePrototype::error("The 'winning_ticket' field is required and must be an array of numbers.");
        }

        if (!is_array($this->data['tickets']) || empty($this->data['tickets'])) {
            ValidateResponsePrototype::error("The 'tickets' field is required and must be an array of tickets.");
        }
    }


    public function input(string $key, $default = null)
    {
        return $this->data[$key] ?? $default;
    }
}
