<?php
/**
 *
 */

namespace MaxLZp\Brickweb\Brackets;

/**
 * Validates brackets sequence
 *
 * @param string $input
 *
 * @return bool
 */
function isValidSequence(string $input): bool
{
    // this behaviour is not specified in the task
    if (strlen($input) === 0 )
    {
        throw new \InvalidArgumentException('Cannot validate. Input is empty.');
    }

    // the sequence is invalid if string length is odd
    if (strlen($input) % 2 !== 0)
    {
        return false;
    }

    $matches = [
        ')' => '(',
        ']' => '[',
        '}' => '{',
    ];

    $stack = new \SplStack();
    for ($i = 0; $i < strlen($input); $i++)
    {
        if (array_key_exists($input[$i], $matches)
            && $stack->count() > 0
            && $matches[$input[$i]] === $stack->top()
        ) {
            $stack->pop();
            continue;
        }
        $stack->push($input[$i]);
    }

    return $stack->count() === 0;
}
