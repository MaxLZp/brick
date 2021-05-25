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

//    $pattern = '/(?P<tag><a|<img|<script)(?P<attributes1>.*)(?P<link>src|href)="(?P<linkValue>\S*)"(?P<attributes2>.*>)/mUi';
    $pattern = '/(?P<tag><a|<img|<script)(?P<attributes1>.*)(?P<link>src|href)="(?P<linkValue>[^?"]*+)[?"]?(?P<query>.*)"(?P<attributes2>.*>)/mUi';
    $str = preg_replace_callback(
        $pattern,
        function(array $matches):string {
            $updated = '' === $matches['query']
                ? sprintf("?v=%u", crc32($matches['linkValue']))
                : sprintf("%s&v=%u", $matches['query'], crc32($matches['linkValue'].$matches['query']));
            return sprintf("%s%s%s=\"%s%s\"%s",
                $matches['tag'],
                $matches['attributes1'],
                $matches['link'],
                $matches['linkValue'],
                $updated,
                $matches['attributes2']);
        },
        $input);
    return $str;
}