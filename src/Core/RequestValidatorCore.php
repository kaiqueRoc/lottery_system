<?php
namespace Core;

use Prototype\Response\ValidateResponsePrototype;

class RequestValidatorCore
{
    public static function validateGenerateTickets($quantity, $numbers): void
    {
        if (!is_int($quantity) || $quantity <= 0) {
            ValidateResponsePrototype::error("Invalid ticket quantity. It must be a positive integer greater than 0.");
        }

        if (!is_int($numbers) || $numbers <= 0) {
            ValidateResponsePrototype::error("The number of ticket digits must be a positive integer greater than 0.");
        }
    }

    public static function validateCheckTickets($winningTicket, $tickets): void
    {
        if (!is_array($winningTicket) || count($winningTicket) < 1) {
            ValidateResponsePrototype::error("The winning ticket must be provided as a non-empty array.");
        }

        if (!is_array($tickets) || count($tickets) < 1) {
            throw new \InvalidArgumentException("Tickets must be provided in an array format.");
        }

        foreach ($tickets as $ticket) {
            if (!is_array($ticket)) {
                ValidateResponsePrototype::error("Each ticket must be an array of numbers.");
            }
        }
    }
}
