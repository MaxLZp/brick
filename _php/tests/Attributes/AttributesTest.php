<?php
/**
 *
 */

namespace MaxLZp\Brickweb\Tests\Attributes;

use function MaxLZp\Brickweb\Attributes\update;

use PHPUnit\Framework\TestCase;

class AttributesTest extends TestCase
{

    /**
     * @test
     * @dataProvider shouldUpdateDataProvider
     *
     * @param string $input
     * @param string   $expected
     */
    public function shouldUpdate(string $input, string $expected)
    {
        $this->assertEquals($expected, update($input));
    }

    /**
     * @return array
     */
    public function shouldUpdateDataProvider(): array
    {
        return [
            [
                '<a href="test.com">test</a>',
                '<a href="test.com?v=' . sprintf("%u", crc32("test.com")) . '">test</a>',
            ],
            [
                '<img src="img1.jpg" alt="img1" />',
                '<img src="img1.jpg?v=' . sprintf("%u", crc32("img1.jpg")) . '" alt="img1" />',
            ],
            [
                '<script src="script.js"></script>',
                '<script src="script.js?v=' . sprintf("%u", crc32("script.js")) . '"></script>',
            ],
            [
                '<img data-value1="123" src="img1.jpg" alt="img1" />',
                '<img data-value1="123" src="img1.jpg?v=' . sprintf("%u", crc32("img1.jpg")) . '" alt="img1" />',
            ],
            [
                '<img data-value1="123" src="img1.jpg" alt="img1" /><a href="test.com">test</a><script src="script.js"></script>',
                '<img data-value1="123" src="img1.jpg?v=' . sprintf("%u", crc32("img1.jpg")) . '" alt="img1" />' .
                    '<a href="test.com?v=' . sprintf("%u", crc32("test.com")) . '">test</a>' .
                    '<script src="script.js?v=' . sprintf("%u", crc32("script.js")) . '"></script>',
            ],
            [
                '<div>...</div>',
                '<div>...</div>',
            ],
            [
                '<iframe src="URL">...</iframe>',
                '<iframe src="URL">...</iframe>',
            ],
            //new cases
            [
                '<img data-value1="123" src="img1.jpg?p=123" alt="img1" />',
                '<img data-value1="123" src="img1.jpg?p=123&v=' . sprintf("%u", crc32("img1.jpg?p=123")) . '" alt="img1" />',
            ],
            [
                '<img data-value1="123" src="img1.jpg?p=123&v=321" alt="img1" />',
                '<img data-value1="123" src="img1.jpg?p=123&v=321&v=' . sprintf("%u", crc32("img1.jpg?p=123&v=321")) . '" alt="img1" />',
            ],
        ];
    }
}
