<?php
/**
 * Created by PhpStorm.
 * User: gumennikov
 * Date: 17.05.2019
 * Time: 13:03
 */

$re = '/[A-z]+\S/';
$str = 'sddfdsf sdfsdf ';

preg_match($re, $str, $matches, PREG_OFFSET_CAPTURE, 0);

// Print the entire match result
var_dump($matches);