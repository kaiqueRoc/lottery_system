<?php

namespace Services;

use Models\Ticket;
use Prototype\Response\ValidateResponsePrototype;

class TicketService
{
    public function generateTickets($quantity, $numbers): array
    {
        if (!isset($quantity) || !is_int($quantity) || $quantity <= 0) {
            ValidateResponsePrototype::error("The 'quantity' field is required and must be a positive integer.");
        }

        if (!isset($numbers) || !is_int($numbers) || $numbers <= 0) {
            ValidateResponsePrototype::error("The 'numbers' field is required and must be an integer.");
        }

        $tickets = [];
        for ($i = 0; $i < $quantity; $i++) {
            $ticketNumbers = range(1, 60);
            shuffle($ticketNumbers);
            $ticketNumbers = array_slice($ticketNumbers, 0, $numbers);
            sort($ticketNumbers);
            $tickets[] = new Ticket($ticketNumbers);
        }

        return $tickets;
    }
    public function checkTickets(array $winningTicket, array $tickets): array
    {
        $results = [];

        foreach ($tickets as $ticket) {
            $ticketNumbers = is_array($ticket) ? $ticket : $ticket->getNumbers();
            $matches = array_intersect($winningTicket, $ticketNumbers);

            $results[] = [
                'ticket' => $ticketNumbers,
                'matches' => array_values($matches)
            ];
        }

        return $results;
    }

}
