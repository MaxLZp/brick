<?php
//https://sandbox.onlinephpfunctions.com/

$v= 0;
printMemory('init');
$arr = range(1,1000);
printMemory('arr create');
asValue($arr);
printMemory('after asValue');
asRef($arr);
printMemory('after asRef');

function printMemory($msg = '')
{
    global $v;
    $vc = memory_get_usage();
    $vd = $vc-$v;
    $v = $vc;
    echo $msg . ' : ' . $vc . '('. $vd . '); ' . PHP_EOL;
}

function asRef(&$arr) {
    printMemory('in asRef before');
    $clone = $arr;
    printMemory('in asRef middle');
    $clone[] = 101;
    printMemory('in asRef after');
}

function asValue($arr) {
    printMemory('in asValue before');
    $clone = $arr;
    printMemory('in asValue middle');
    $clone[] = 101;
    printMemory('in asValue after');
}