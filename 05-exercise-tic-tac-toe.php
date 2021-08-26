<?php

$board = [
    [" ", " ", " "],
    [" ", " ", " "],
    [" ", " ", " "]
];

function display (array $board): void {
    echo " {$board[0][0]} | {$board[0][1]} | {$board[0][2]}" . PHP_EOL;
    echo "---+---+---" . PHP_EOL;
    echo " {$board[1][0]} | {$board[1][1]} | {$board[1][2]}" . PHP_EOL;
    echo "---+---+---" . PHP_EOL;
    echo " {$board[2][0]} | {$board[2][1]} | {$board[2][2]}" . PHP_EOL;
}

$isOccupied = function (int $row, int $column) use (&$board): bool {
    return $board[$row][$column] !== " ";
};

$isTie = function () use (&$board): bool {
    for ($r = 0; $r < 3; $r++) {
        for ($c = 0; $c < 3; $c++) {
            if ($board[$r][$c] === " ") {
                return false;
            }
        }
    }
    return true;
};

display($board);

$game = true;

$player1 = 'X';
$player2 = '0';

$currentPlayer = $player1;

while ($game) {
    $input = explode(" ", readline("'{$currentPlayer}', choose your location (row, column): "));

    if (count($input) !== 2) {
        echo "Invalid input!" . PHP_EOL;
        continue;
    }

    [$row, $column] = $input;
    $validInput = [0, 1, 2];

    $row = is_numeric($row) ? (int) $row : $row;
    $column = is_numeric($column) ? (int) $column : $column;

    if (!in_array($row, $validInput, true) || !in_array($column, $validInput, true)) {
        echo "Invalid input!" . PHP_EOL;
        continue;
    }

    if ($isOccupied($row, $column)) {
        echo "That slot is taken!" . PHP_EOL;
        continue;
    }

    $board[$row][$column] = $currentPlayer;

    display($board);

    for ($i = 0; $i < 3; $i++) {
        if ($board[$i][0] == $currentPlayer && $board[$i][1] == $currentPlayer && $board[$i][2] == $currentPlayer) {
            echo "The winner is '{$currentPlayer}'!" . PHP_EOL;
            exit;
        }
    }

    for ($i = 0; $i < 3; $i++) {
        if ($board[0][$i] == $currentPlayer && $board[1][$i] == $currentPlayer && $board[2][$i] == $currentPlayer) {
            echo "The winner is '{$currentPlayer}'!" . PHP_EOL;
            exit;
        }
    }

    if ($board[0][0] == $currentPlayer && $board[1][1] == $currentPlayer && $board[2][2] == $currentPlayer) {
        echo "The winner is '{$currentPlayer}'!" . PHP_EOL;
        exit;
    }

    if ($board[0][2] == $currentPlayer && $board[1][1] == $currentPlayer && $board[2][0] == $currentPlayer) {
        echo "The winner is '{$currentPlayer}'!" . PHP_EOL;
        exit;
    }

    if ($isTie()) {
        $game = false;
        echo "The game is tie" . PHP_EOL;
    }

    $currentPlayer = $currentPlayer === $player1 ? $player2 : $player1;
}