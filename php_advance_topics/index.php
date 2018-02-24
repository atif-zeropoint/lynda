<?php
require __DIR__ . '/vendor/autoload.php';
use Rych\Random\Random;

echo (new Random())->getRandomInteger(0,5);