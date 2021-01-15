<?php



function getOddNumbers($list) {
    $result = array();
    $ArrayLength = count($list);
    for ($i = 0; $i < $ArrayLength; $i++) {
        $value = $list[$i];
        if ($value % 2==0){
        }
        else {
            array_push($result,$value);
        }

    }
    foreach ($result as $num) {
        print $num . PHP_EOL;
       }


}
//Tagastab [1,3]
getOddNumbers([1, 2, 3]);