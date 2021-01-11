<?php 

function C2FCalc($data){
    $temp =  $data * 9/5 + 32;
    return $temp;
}




header('Location: c2f_result.html');