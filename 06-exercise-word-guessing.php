<?php

$words = [
    'recommendation', 'election', 'selection', 'competition', 'employee',
    'analysis', 'relationship', 'medicine', 'database', 'negotiation',
    'opportunity', 'consequence', 'entertainment', 'response', 'midnight',
    'significance', 'preparation', 'discussion', 'procedure', 'distribution',
    'contribution', 'education', 'painting', 'awareness', 'elevator',
    'baseball', 'assumption', 'difficulty', 'maintenance', 'combination',
    'promotion', 'indication', 'atmosphere', 'audience', 'performance',
    'classroom', 'department', 'requirement', 'weakness', 'comparison',
    'variation', 'reaction', 'addition', 'proposal', 'membership',
    'knowledge', 'leadership', 'resource', 'permission', 'definition',
];

//Edit the value below to change the number of guesses that player has
$numberOfGuesses = 20;

$wordToGuess = $words[rand(0, count($words))];
$letters = str_split($wordToGuess);

$guessedLetters = [];
$missedLetters = [];

$game = true;

while ($game) {
    $string = [];

    echo "-=-=-=-=-=-=-=-=-=-=-=-=-=-" . PHP_EOL;
    echo "Word:  ";

    if (empty($guessedLetters)) {
        for ($i = 0; $i < strlen($wordToGuess); $i++) {
            $string[] = "_";
        }
    } else {
        for ($i = 0; $i < strlen($wordToGuess); $i++) {
            if (in_array($letters[$i], $guessedLetters)) {
                $string[] = $letters[$i];
            } else {
                $string[] = "_";
            }
        }
    }
    foreach ($string as $item) {
        echo $item . " ";
    }
    echo PHP_EOL;

    echo "Misses: ";
    foreach ($missedLetters as $letter) {
        echo $letter . " ";
    }
    echo PHP_EOL;

    if (!in_array("_", $string)) {
        echo "YOU GOT IT!";
        $game = false;
        break;
    }

    $input = readline('Guess: ');

    if (in_array($input, $guessedLetters)) {
        echo "You already guessed this letter! Pick another one!" . PHP_EOL;
        continue;
    }

    if (in_array($input, $missedLetters)) {
        echo "You already missed this letter! Pick another one!" . PHP_EOL;
        continue;
    }

    if (in_array($input, $letters)) {
        $guessedLetters[] = $input;
    } else {
        $missedLetters[] = $input;
    }

    if ($numberOfGuesses == 0) {
        exit("You ran out of guesses!");
    }
    $numberOfGuesses--;
}
