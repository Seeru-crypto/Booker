<?php

$numbers = [3, 2, 5, 6];

makeString1($numbers);


function makeString1 ($array){
    $string=join(", ",$array);
    //echo $string;
    StringToArray1 ($string);

}

function makeString2($array){
    $string ="";
    foreach ($array as $value ){
        $string=$string.", ".$value;
    }
    $string = substr ($string,1);
    echo $string;
}
function StringToArray1 ($string) {
    $array=(explode(" ",$string));
    foreach ($array as $value){
        echo $value;
    }

}