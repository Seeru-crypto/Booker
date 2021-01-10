<?php

function calc($nr) {

        if ($nr % 3 == 0) {
            if ($nr %  5 == 0){echo ("FizzBuzz");}
            else {echo ("Fizz");}
        }
        elseif ($nr % 5 == 0){
            echo ("Buzz");
        }
        else {
            echo ($nr);
        }



}



//fizz
calc(3);
//buzz
calc(5);
//fizzBu<<
calc(15);
//2
calc(2);