<?php

  

function CountNum($numbers) {  
    $counter = 0;
    $searchValue=3;
    $ArrayLength = count ($numbers);


    for ($i = 0; $i < $ArrayLength; $i++) {

        if ($numbers[$i]===$searchValue){
            $counter += 1;
        }
        else {
            $counter = $counter;
        }

       }
        print ("This counter result: ");
    echo $counter;}




$numbers = [1, 2, '3', 6, 2, 3, 2, 3];
CountNum($numbers);



