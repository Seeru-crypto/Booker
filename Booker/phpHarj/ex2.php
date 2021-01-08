<?php

$numbers = [1, 2, '3', 6, 2, 3, 2, 3];

function isInList($list, $elementToBeFound) {
    $ArrayLength = count ($list);
    $result = false;
    for ($i = 0; $i < $ArrayLength; $i++) {
        if ($list[$i]==$elementToBeFound){
            $result = true;
        }
        else {
        }}
        var_dump($result);}



//Tagastab true
isInList([1, 2, 3], 2);
//Tagastab False
isInList([1, 2, 3], 4);