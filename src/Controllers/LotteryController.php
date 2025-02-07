<?php

namespace Controllers;

use Core\RequestValidatorCore;
use Core\ResponseValidatorCore;
use Enum\HttpStatusCode;
use InvalidArgumentException;
use Services\LotteryService;
use Services\TicketService;

class LotteryController
{
    private LotteryService $lotteryService;
    private TicketService $ticketService;

    public function __construct()
    {
        $this->lotteryService = new LotteryService();
        $this->ticketService = new TicketService();
    }

    public function generateWinningTicket(): void
    {
        try {
            $winningTicket = $this->lotteryService->generateWinningTicket();
            ResponseValidatorCore::json(['winning_ticket' => $winningTicket]);
        } catch (InvalidArgumentException $e) {
            ResponseValidatorCore::error("Error  generated tickets winner: " . $e->getMessage());
        } catch (\Exception $e) {
            ResponseValidatorCore::error("Error  generated tickets winner: " . $e->getMessage(), HttpStatusCode::INTERNAL_SERVER_ERROR);
        }

    }

    public function generateTickets($quantity, $numbers): void
    {
        try {
            RequestValidatorCore::validateGenerateTickets($quantity, $numbers);

            $tickets = $this->ticketService->generateTickets($quantity, $numbers);
            $ticketsArray = array_map(function ($ticket) {
                return $ticket->getNumbers();
            }, $tickets);

            ResponseValidatorCore::json(['tickets' => $ticketsArray]);
        } catch (InvalidArgumentException $e) {
            ResponseValidatorCore::error($e->getMessage(), HttpStatusCode::BAD_REQUEST);
        } catch (\Exception $e) {
            ResponseValidatorCore::error("Error generated tickets: " . $e->getMessage(), HttpStatusCode::INTERNAL_SERVER_ERROR);
        }
    }

    public function checkTickets($winningTicket, $tickets): void
    {
        try {
            RequestValidatorCore::validateCheckTickets($winningTicket, $tickets);

            $results = $this->ticketService->checkTickets($winningTicket, $tickets);

            include 'Views/results.php';

        } catch (InvalidArgumentException $e) {
            ResponseValidatorCore::error($e->getMessage(), HttpStatusCode::BAD_REQUEST);
        } catch (\Exception $e) {
            ResponseValidatorCore::error("Error checked tickets: " . $e->getMessage(), HttpStatusCode::INTERNAL_SERVER_ERROR);
        }
    }
}
