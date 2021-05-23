<?php
/**
 *
 */

namespace MaxLZp\Brickweb\Tests\Brackets;

use PHPUnit\Framework\TestCase;
use function MaxLZp\Brickweb\Brackets\isValidSequence;

class BracketsTest extends TestCase
{
    /**
     * @test
     */
    public function shouldThrowInvalidArgumentException()
    {
        $this->expectException(\InvalidArgumentException::class);
        isValidSequence('');
    }

    /**
     * @test
     * @dataProvider shouldValidateDataProvider
     *
     * @param string $input
     * @param bool   $expected
     */
    public function shouldValidate(string $input, bool $expected)
    {
        $this->assertEquals($expected, isValidSequence($input));
    }

    /**
     * @return array
     */
    public function shouldValidateDataProvider(): array
    {
        return [
            [
                '(){}[]',
                true
            ],
            [
                '(}',
                false
            ],
            [
                '[(])',
                false
            ],
            [
                '([{}])',
                true
            ],
            // additional clauses
            [
                '([{}]',
                false
            ],
            [
                ')[{}])',
                false
            ],
            [
                '([{()}])',
                true
            ],
        ];
    }
}
