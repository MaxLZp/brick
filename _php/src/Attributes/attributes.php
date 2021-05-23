<?php
/**
 *
 */
namespace MaxLZp\Brickweb\Attributes;

/**
 * Update src/href attributes value with hash
 *
 * @param string $input
 *
 * @return string
 */
function update(string $input): string
{
    $pattern = '/(?P<tag><a|<img|<script)(?P<attributes1>.*)(?P<link>src|href)="(?P<linkValue>\S*)"(?P<attributes2>.*>)/mUi';
    $str = preg_replace_callback(
        $pattern,
        function(array $matches):string {
//            return sprintf("%s%s%s=\"%s?v=%u\"%s", $matches[1], $matches[2], $matches[3], $matches[4], crc32($matches[4]), $matches[5]);
            return sprintf("%s%s%s=\"%s?v=%u\"%s",
                $matches['tag'],
                $matches['attributes1'],
                $matches['link'],
                $matches['linkValue'],
                crc32($matches['linkValue']),
                $matches['attributes2']);
        },
        $input);
    return $str;
}