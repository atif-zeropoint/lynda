<?php
$array = [0,1,2,3,4,5,6,7,8,9];

$even = array_filter($array, function($item){
    return ($item % 2 == 0);
});

print_r($array);
print_r($even);

$oddFunction = function($item) {
    return ($item % 2 == 1);
};

$odd = array_filter($array, $oddFunction);

print_r($odd);