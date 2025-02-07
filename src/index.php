<?php

require __DIR__ . '/../vendor/autoload.php';

use Core\Router;
use Controllers\LotteryController;
use Request\GenerateTicketsRequest;
use Request\CheckTicketsRequest;

$router = new Router();
$lotteryController = new LotteryController();


$router->addRoute('GET', '/generate-winning-ticket', function () use ($lotteryController) {
    $lotteryController->generateWinningTicket();
});

$router->addRoute('POST', '/generate-tickets', function () use ($lotteryController) {
    $request = new GenerateTicketsRequest();
    $request->validate();

    $lotteryController->generateTickets(
        $request->input('quantity'),
        $request->input('numbers')
    );

});

$router->addRoute('GET', '/check-tickets', function () use ($lotteryController) {
    $request = new CheckTicketsRequest();
    $request->validate();

    $lotteryController->checkTickets(
        $request->input('winning_ticket'),
        $request->input('tickets')
    );

});

$router->dispatch();
