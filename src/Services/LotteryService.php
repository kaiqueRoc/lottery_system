<?php

namespace Services;

class LotteryService
{
    public function generateWinningTicket(): array
    {
        $numbers = range(1, 60);
        shuffle($numbers);
        $winningNumbers = array_slice($numbers, 0, 6);
        sort($winningNumbers);
        return $winningNumbers;
    }
}