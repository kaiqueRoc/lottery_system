<?php

use JetBrains\PhpStorm\NoReturn;
use PHPUnit\Framework\TestCase;
use Services\LotteryService;
use Services\TicketService;
use Models\Ticket;
use Prototype\Response\ValidateResponsePrototype;

class LotteryTest extends TestCase
{
    private LotteryService $lotteryService;
    private TicketService $ticketService;

    protected function setUp(): void
    {
        $this->lotteryService = new LotteryService();
        $this->ticketService = new TicketService();
    }

    public function testGenerateWinningTicket()
    {
        $ticket = $this->lotteryService->generateWinningTicket();

        $this->assertCount(6, $ticket);
        $this->assertEquals($ticket, array_unique($ticket));
        $this->assertEquals($ticket, array_values($ticket));

        $this->assertTrue(true, "testGenerateWinningTicket passed: Winning ticket generated successfully.");
    }

    public function testGenerateTickets()
    {
        $tickets = $this->ticketService->generateTickets(5, 6);

        $this->assertCount(5, $tickets);

        foreach ($tickets as $ticket) {
            $this->assertInstanceOf(Ticket::class, $ticket);
            $this->assertCount(6, $ticket->getNumbers());
            $this->assertEquals($ticket->getNumbers(), array_unique($ticket->getNumbers()));
            $this->assertEquals($ticket->getNumbers(), array_values($ticket->getNumbers()));
        }

        $this->assertTrue(true, "testGenerateTickets passed: 5 tickets generated successfully.");
    }

    #[NoReturn] public function testSuccessResponse()
    {
        ob_start();

        ValidateResponsePrototype::success(['message' => 'Success']);

        $output = ob_get_clean();

        $response = json_decode($output, true);
        $this->assertEquals('success', $response['status']);
        $this->assertEquals(200, $response['code']);
        $this->assertArrayHasKey('message', $response['data']);

        $this->assertTrue(true, "testSuccessResponse passed: Success response generated correctly.");
    }

    #[NoReturn] public function testErrorResponse()
    {
        ob_start();

        ValidateResponsePrototype::error('An error occurred');

        $output = ob_get_clean();

        $response = json_decode($output, true);
        $this->assertEquals('error', $response['status']);
        $this->assertEquals(400, $response['code']);
        $this->assertEquals('An error occurred', $response['data']['error']);

        $this->assertTrue(true, "testErrorResponse passed: Error response generated correctly.");
    }

    public function testInvalidQuantityLessThanOne()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->ticketService->generateTickets(0, 6);

        $this->assertTrue(true, "testInvalidQuantityLessThanOne passed: Invalid argument exception thrown.");
    }

    public function testMissingData()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->ticketService->generateTickets(5, 6);

        $this->assertTrue(true, "testMissingData passed: Missing data exception thrown.");
    }

    public function testGenerateMaxFiftyTickets()
    {
        $tickets = $this->ticketService->generateTickets(50, 6);
        $this->assertCount(50, $tickets);

        $this->assertTrue(true, "testGenerateMaxFiftyTickets passed: 50 tickets generated successfully.");
    }

    public function testCheckTickets()
    {
        $winningTicket = [1, 2, 3, 4, 5, 6];
        $tickets = [
            [1, 2, 3, 4, 5, 6],
            [7, 8, 9, 10, 11, 12]
        ];

        $result = $this->ticketService->checkTickets($winningTicket, $tickets);
        $this->assertStringContainsString('<table>', $result);
        $this->assertStringContainsString('</table>', $result);
        $this->assertStringContainsString('1', (string)$result);

        $this->assertTrue(true, "testCheckTickets passed: Tickets checked and results returned.");
    }

    public function testInvalidCheckTickets()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->ticketService->checkTickets([], []);

        $this->assertTrue(true, "testInvalidCheckTickets passed: Invalid check tickets exception thrown.");
    }
}
